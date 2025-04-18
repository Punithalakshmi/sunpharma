<?php

declare (strict_types=1);
namespace Rector\Privatization\Rector\Class_;

use RectorPrefix20220609\Nette\Utils\Strings;
use PhpParser\Node;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassConst;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Core\NodeManipulator\ClassInsertManipulator;
use Rector\Core\Php\ReservedKeywordAnalyzer;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\Util\StaticRectorStrings;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @see \Rector\Tests\Privatization\Rector\Class_\RepeatedLiteralToClassConstantRector\RepeatedLiteralToClassConstantRectorTest
 */
final class RepeatedLiteralToClassConstantRector extends AbstractRector
{
    /**
     * @var string
     */
    private const VALUE = 'value';
    /**
     * @var string
     */
    private const NUMBERS = 'numbers';
    /**
     * @var string
     */
    private const UNDERSCORE = '_';
    /**
     * @var int
     */
    private const MINIMAL_VALUE_OCCURRENCE = 3;
    /**
     * @var string
     * @see https://regex101.com/r/osJLMF/1
     */
    private const SLASH_AND_DASH_REGEX = '#[-\\\\/]#';
    /**
     * @readonly
     * @var \Rector\Core\NodeManipulator\ClassInsertManipulator
     */
    private $classInsertManipulator;
    /**
     * @readonly
     * @var \Rector\Core\Php\ReservedKeywordAnalyzer
     */
    private $reservedKeywordAnalyzer;
    public function __construct(ClassInsertManipulator $classInsertManipulator, ReservedKeywordAnalyzer $reservedKeywordAnalyzer)
    {
        $this->classInsertManipulator = $classInsertManipulator;
        $this->reservedKeywordAnalyzer = $reservedKeywordAnalyzer;
    }
    public function getRuleDefinition() : RuleDefinition
    {
        return new RuleDefinition('Replace repeated strings with constant', [new CodeSample(<<<'CODE_SAMPLE'
class SomeClass
{
    public function run($key, $items)
    {
        if ($key === 'requires') {
            return $items['requires'];
        }
    }
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
class SomeClass
{
    /**
     * @var string
     */
    private const REQUIRES = 'requires';
    public function run($key, $items)
    {
        if ($key === self::REQUIRES) {
            return $items[self::REQUIRES];
        }
    }
}
CODE_SAMPLE
)]);
    }
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes() : array
    {
        return [Class_::class];
    }
    /**
     * @param Class_ $node
     */
    public function refactor(Node $node) : ?Node
    {
        // skip tests, where string values are often used as fixtures
        if ($this->isName($node, '*Test')) {
            return null;
        }
        /** @var String_[] $strings */
        $strings = $this->betterNodeFinder->findInstanceOf($node, String_::class);
        $stringsToReplace = $this->resolveStringsToReplace($strings);
        if ($stringsToReplace === []) {
            return null;
        }
        $this->replaceStringsWithClassConstReferences($node, $stringsToReplace);
        $this->addClassConsts($stringsToReplace, $node);
        return $node;
    }
    /**
     * @param String_[] $strings
     * @return string[]
     */
    private function resolveStringsToReplace(array $strings) : array
    {
        $stringsByValue = [];
        foreach ($strings as $string) {
            if ($this->shouldSkipString($string)) {
                continue;
            }
            $stringsByValue[$string->value][] = $string;
        }
        $stringsToReplace = [];
        /**
         * NOTE: Although value may be a string when entered as an index, it can be
         * an integer when retrieved (e.g. '100')
         * @var array-key $value
         */
        foreach ($stringsByValue as $value => $strings) {
            if (\count($strings) < self::MINIMAL_VALUE_OCCURRENCE) {
                continue;
            }
            $stringsToReplace[] = (string) $value;
        }
        return $stringsToReplace;
    }
    /**
     * @param string[] $stringsToReplace
     */
    private function replaceStringsWithClassConstReferences(Class_ $class, array $stringsToReplace) : void
    {
        $classConsts = $class->getConstants();
        $this->traverseNodesWithCallable($class, function (Node $node) use($stringsToReplace, $classConsts) : ?ClassConstFetch {
            if (!$node instanceof String_) {
                return null;
            }
            if (!$this->valueResolver->isValues($node, $stringsToReplace)) {
                return null;
            }
            $isInMethod = (bool) $this->betterNodeFinder->findParentType($node, ClassMethod::class);
            if (!$isInMethod) {
                return null;
            }
            $constantName = $this->createConstName($node->value);
            if ($this->isClassConstExistsWithDifferentValue($classConsts, $constantName, $node->value)) {
                return null;
            }
            return $this->nodeFactory->createSelfFetchConstant($constantName);
        });
    }
    /**
     * @param ClassConst[] $classConsts
     */
    private function isClassConstExistsWithDifferentValue(array $classConsts, string $constantName, string $value) : bool
    {
        foreach ($classConsts as $classConst) {
            $consts = $classConst->consts;
            foreach ($consts as $const) {
                if (!$this->nodeNameResolver->isName($const->name, $constantName)) {
                    continue;
                }
                if (!$this->valueResolver->isValue($const->value, $value)) {
                    return \true;
                }
            }
        }
        return \false;
    }
    /**
     * @param string[] $stringsToReplace
     */
    private function addClassConsts(array $stringsToReplace, Class_ $class) : void
    {
        foreach ($stringsToReplace as $stringToReplace) {
            $constantName = $this->createConstName($stringToReplace);
            $classConst = $this->nodeFactory->createClassConstant($constantName, new String_($stringToReplace), Class_::MODIFIER_PRIVATE);
            $this->classInsertManipulator->addConstantToClass($class, $stringToReplace, $classConst);
        }
    }
    private function shouldSkipString(String_ $string) : bool
    {
        $value = $string->value;
        // value is too short
        if (\strlen($value) < 2) {
            return \true;
        }
        if ($this->reservedKeywordAnalyzer->isReserved($value)) {
            return \true;
        }
        if ($this->isNativeConstantResemblingValue($value)) {
            return \true;
        }
        // is replaceable value?
        $matches = Strings::match($value, '#(?<' . self::VALUE . '>[\\w\\-\\/\\_]+)#');
        if (!isset($matches[self::VALUE])) {
            return \true;
        }
        // skip values in another constants
        $parentConst = $this->betterNodeFinder->findParentType($string, ClassConst::class);
        if ($parentConst !== null) {
            return \true;
        }
        return $matches[self::VALUE] !== $string->value;
    }
    private function createConstName(string $value) : string
    {
        // replace slashes and dashes
        $value = Strings::replace($value, self::SLASH_AND_DASH_REGEX, self::UNDERSCORE);
        // find beginning numbers
        $beginningNumbers = '';
        $matches = Strings::match($value, '#(?<' . self::NUMBERS . '>[0-9]*)(?<' . self::VALUE . '>.*)#');
        if (isset($matches[self::NUMBERS])) {
            $beginningNumbers = $matches[self::NUMBERS];
        }
        if (isset($matches[self::VALUE])) {
            $value = $matches[self::VALUE];
        }
        // convert camelcase parts to underscore
        $parts = \explode(self::UNDERSCORE, (string) $value);
        $parts = \array_map(function (string $value) : string {
            return StaticRectorStrings::camelCaseToUnderscore($value);
        }, $parts);
        // apply "CONST" prefix if constant beginning with number
        if ($beginningNumbers !== '') {
            $parts = \array_merge(['CONST', $beginningNumbers], $parts);
            $parts = \array_filter($parts);
        }
        $value = \implode(self::UNDERSCORE, $parts);
        return \strtoupper(Strings::replace($value, '#_+#', self::UNDERSCORE));
    }
    private function isNativeConstantResemblingValue(string $value) : bool
    {
        $loweredValue = \strtolower($value);
        return \in_array($loweredValue, ['true', 'false', 'bool', 'null'], \true);
    }
}
