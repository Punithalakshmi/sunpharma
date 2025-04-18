<?php

declare (strict_types=1);
namespace PHPStan\Rules\PHPUnit;

use Countable;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\NodeAbstract;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Type\ObjectType;
use function count;
use function strtolower;
/**
 * @implements Rule<NodeAbstract>
 */
class AssertSameWithCountRule implements Rule
{
    public function getNodeType() : string
    {
        return NodeAbstract::class;
    }
    public function processNode(Node $node, Scope $scope) : array
    {
        if (!\PHPStan\Rules\PHPUnit\AssertRuleHelper::isMethodOrStaticCallOnAssert($node, $scope)) {
            return [];
        }
        /** @var MethodCall|StaticCall $node */
        $node = $node;
        if (count($node->getArgs()) < 2) {
            return [];
        }
        if (!$node->name instanceof Node\Identifier || strtolower($node->name->name) !== 'assertsame') {
            return [];
        }
        $right = $node->getArgs()[1]->value;
        if ($right instanceof Node\Expr\FuncCall && $right->name instanceof Node\Name && strtolower($right->name->toString()) === 'count') {
            return ['You should use assertCount($expectedCount, $variable) instead of assertSame($expectedCount, count($variable)).'];
        }
        if ($right instanceof Node\Expr\MethodCall && $right->name instanceof Node\Identifier && strtolower($right->name->toString()) === 'count' && count($right->getArgs()) === 0) {
            $type = $scope->getType($right->var);
            if ((new ObjectType(Countable::class))->isSuperTypeOf($type)->yes()) {
                return ['You should use assertCount($expectedCount, $variable) instead of assertSame($expectedCount, $variable->count()).'];
            }
        }
        return [];
    }
}
