<?php

declare (strict_types=1);
namespace Rector\PHPOffice\Rector\StaticCall;

use PhpParser\Node;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name\FullyQualified;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @changelog https://github.com/PHPOffice/PhpSpreadsheet/blob/master/docs/topics/migration-from-PHPExcel.md#simplified-iofactory
 *
 * @see \Rector\PHPOffice\Tests\Rector\StaticCall\ChangeSearchLocationToRegisterReaderRector\ChangeSearchLocationToRegisterReaderRectorTest
 */
final class ChangeSearchLocationToRegisterReaderRector extends AbstractRector
{
    public function getRuleDefinition() : RuleDefinition
    {
        return new RuleDefinition('Change argument addSearchLocation() to registerReader()', [new CodeSample(<<<'CODE_SAMPLE'
final class SomeClass
{
    public function run(): void
    {
        \PHPExcel_IOFactory::addSearchLocation($type, $location, $classname);
    }
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
final class SomeClass
{
    public function run(): void
    {
        \PhpOffice\PhpSpreadsheet\IOFactory::registerReader($type, $classname);
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
        return [StaticCall::class];
    }
    /**
     * @param StaticCall $node
     */
    public function refactor(Node $node) : ?Node
    {
        $callerType = $this->nodeTypeResolver->getType($node->class);
        if (!$callerType->isSuperTypeOf(new ObjectType('PHPExcel_IOFactory'))->yes()) {
            return null;
        }
        if (!$this->isName($node->name, 'addSearchLocation')) {
            return null;
        }
        $node->class = new FullyQualified('PhpOffice\\PhpSpreadsheet\\IOFactory');
        $node->name = new Identifier('registerReader');
        // remove middle argument
        $args = $node->args;
        unset($args[1]);
        $node->args = \array_values($args);
        return $node;
    }
}
