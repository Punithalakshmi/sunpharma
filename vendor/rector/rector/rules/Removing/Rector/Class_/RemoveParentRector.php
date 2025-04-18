<?php

declare (strict_types=1);
namespace Rector\Removing\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Reflection\ClassReflection;
use Rector\Core\Contract\Rector\ConfigurableRectorInterface;
use Rector\Core\Rector\AbstractRector;
use Rector\NodeCollector\ScopeResolver\ParentClassScopeResolver;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use RectorPrefix20220609\Webmozart\Assert\Assert;
/**
 * @see \Rector\Tests\Removing\Rector\Class_\RemoveParentRector\RemoveParentRectorTest
 */
final class RemoveParentRector extends AbstractRector implements ConfigurableRectorInterface
{
    /**
     * @var string[]
     */
    private $parentClassesToRemove = [];
    /**
     * @readonly
     * @var \Rector\NodeCollector\ScopeResolver\ParentClassScopeResolver
     */
    private $parentClassScopeResolver;
    public function __construct(ParentClassScopeResolver $parentClassScopeResolver)
    {
        $this->parentClassScopeResolver = $parentClassScopeResolver;
    }
    public function getRuleDefinition() : RuleDefinition
    {
        return new RuleDefinition('Removes extends class by name', [new ConfiguredCodeSample(<<<'CODE_SAMPLE'
final class SomeClass extends SomeParentClass
{
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
final class SomeClass
{
}
CODE_SAMPLE
, ['SomeParentClass'])]);
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
        $scope = $node->getAttribute(AttributeKey::SCOPE);
        $parentClassReflection = $this->parentClassScopeResolver->resolveParentClassReflection($scope);
        if (!$parentClassReflection instanceof ClassReflection) {
            return null;
        }
        foreach ($this->parentClassesToRemove as $parentClassToRemove) {
            if ($parentClassReflection->getName() !== $parentClassToRemove) {
                continue;
            }
            // remove parent class
            $node->extends = null;
            return $node;
        }
        return null;
    }
    /**
     * @param mixed[] $configuration
     */
    public function configure(array $configuration) : void
    {
        Assert::allString($configuration);
        $this->parentClassesToRemove = $configuration;
    }
}
