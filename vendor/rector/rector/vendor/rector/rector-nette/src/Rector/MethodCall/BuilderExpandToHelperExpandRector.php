<?php

declare (strict_types=1);
namespace Rector\Nette\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Name\FullyQualified;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @see https://github.com/Kdyby/Doctrine/commit/db80bf77c0b68af88dfe7eddb2cb2db94aedb04a#diff-ccc8ba07edfa3a425ddfe564acb50656R291
 *
 * @see \Rector\Nette\Tests\Rector\MethodCall\BuilderExpandToHelperExpandRector\BuilderExpandToHelperExpandRectorTest
 */
final class BuilderExpandToHelperExpandRector extends AbstractRector
{
    public function getRuleDefinition() : RuleDefinition
    {
        return new RuleDefinition('Change containerBuilder->expand() to static call with parameters', [new CodeSample(<<<'CODE_SAMPLE'
use Nette\DI\CompilerExtension;

final class SomeClass extends CompilerExtension
{
    public function loadConfiguration()
    {
        $value = $this->getContainerBuilder()->expand('%value');
    }
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
use Nette\DI\CompilerExtension;

final class SomeClass extends CompilerExtension
{
    public function loadConfiguration()
    {
        $value = \Nette\DI\Helpers::expand('%value', $this->getContainerBuilder()->parameters);
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
        return [MethodCall::class];
    }
    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node) : ?Node
    {
        if (!$this->isObjectType($node->var, new ObjectType('Nette\\DI\\ContainerBuilder'))) {
            return null;
        }
        if (!$this->isName($node->name, 'expand')) {
            return null;
        }
        $args = $node->args;
        $getContainerBuilderMethodCall = new MethodCall(new Variable('this'), 'getContainerBuilder');
        $parametersPropertyFetch = new PropertyFetch($getContainerBuilderMethodCall, 'parameters');
        $args[] = new Arg($parametersPropertyFetch);
        return new StaticCall(new FullyQualified('Nette\\DI\\Helpers'), 'expand', $args);
    }
}
