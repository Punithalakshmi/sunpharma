<?php

declare (strict_types=1);
namespace Rector\Symfony\Rector\ClassMethod;

use RectorPrefix20220609\Nette\Utils\Strings;
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Return_;
use PHPStan\Type\ObjectType;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\Rector\AbstractRector;
use RectorPrefix20220609\Symfony\Component\String\UnicodeString;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @see https://github.com/symfony/symfony/blob/3.4/UPGRADE-3.0.md#form
 *
 * @see \Rector\Symfony\Tests\Rector\ClassMethod\RemoveDefaultGetBlockPrefixRector\RemoveDefaultGetBlockPrefixRectorTest
 */
final class RemoveDefaultGetBlockPrefixRector extends AbstractRector
{
    public function getRuleDefinition() : RuleDefinition
    {
        return new RuleDefinition('Rename `getBlockPrefix()` if it returns the default value - class to underscore, e.g. UserFormType = user_form', [new CodeSample(<<<'CODE_SAMPLE'
use Symfony\Component\Form\AbstractType;

class TaskType extends AbstractType
{
    public function getBlockPrefix()
    {
        return 'task';
    }
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
use Symfony\Component\Form\AbstractType;

class TaskType extends AbstractType
{
}
CODE_SAMPLE
)]);
    }
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes() : array
    {
        return [ClassMethod::class];
    }
    /**
     * @param ClassMethod $node
     */
    public function refactor(Node $node) : ?Node
    {
        if (!$this->isObjectMethodNameMatch($node)) {
            return null;
        }
        $returnedExpr = $this->resolveOnlyStmtReturnExpr($node);
        if (!$returnedExpr instanceof Expr) {
            return null;
        }
        $returnedValue = $this->valueResolver->getValue($returnedExpr);
        $classLike = $this->betterNodeFinder->findParentType($node, ClassLike::class);
        if (!$classLike instanceof ClassLike) {
            return null;
        }
        $className = $this->nodeNameResolver->getName($classLike);
        if (!\is_string($className)) {
            return null;
        }
        $shortClassName = $this->nodeNameResolver->getShortName($className);
        if (\substr_compare($shortClassName, 'Type', -\strlen('Type')) === 0) {
            $shortClassName = (string) Strings::before($shortClassName, 'Type');
        }
        $shortClassNameUnicodeString = new UnicodeString($shortClassName);
        $underscoredClassShortName = $shortClassNameUnicodeString->snake()->toString();
        if ($underscoredClassShortName !== $returnedValue) {
            return null;
        }
        $this->removeNode($node);
        return null;
    }
    private function isObjectMethodNameMatch(ClassMethod $classMethod) : bool
    {
        $class = $this->betterNodeFinder->findParentType($classMethod, Class_::class);
        if (!$class instanceof Class_) {
            return \false;
        }
        if (!$this->isObjectType($classMethod, new ObjectType('Symfony\\Component\\Form\\AbstractType'))) {
            return \false;
        }
        return $this->isName($classMethod->name, 'getBlockPrefix');
    }
    /**
     * return <$thisValue>;
     */
    private function resolveOnlyStmtReturnExpr(ClassMethod $classMethod) : ?Expr
    {
        if (\count((array) $classMethod->stmts) !== 1) {
            return null;
        }
        if (!isset($classMethod->stmts[0])) {
            throw new ShouldNotHappenException();
        }
        $onlyStmt = $classMethod->stmts[0];
        if (!$onlyStmt instanceof Return_) {
            return null;
        }
        return $onlyStmt->expr;
    }
}
