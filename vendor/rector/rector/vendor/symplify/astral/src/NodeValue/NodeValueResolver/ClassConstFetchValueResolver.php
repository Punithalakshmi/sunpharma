<?php

declare (strict_types=1);
namespace RectorPrefix20220609\Symplify\Astral\NodeValue\NodeValueResolver;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Stmt\ClassLike;
use ReflectionClassConstant;
use RectorPrefix20220609\Symplify\Astral\Contract\NodeValueResolver\NodeValueResolverInterface;
use RectorPrefix20220609\Symplify\Astral\Naming\SimpleNameResolver;
use RectorPrefix20220609\Symplify\Astral\NodeFinder\SimpleNodeFinder;
/**
 * @see \Symplify\Astral\Tests\NodeValue\NodeValueResolverTest
 *
 * @implements NodeValueResolverInterface<ClassConstFetch>
 */
final class ClassConstFetchValueResolver implements NodeValueResolverInterface
{
    /**
     * @var \Symplify\Astral\Naming\SimpleNameResolver
     */
    private $simpleNameResolver;
    /**
     * @var \Symplify\Astral\NodeFinder\SimpleNodeFinder
     */
    private $simpleNodeFinder;
    public function __construct(SimpleNameResolver $simpleNameResolver, SimpleNodeFinder $simpleNodeFinder)
    {
        $this->simpleNameResolver = $simpleNameResolver;
        $this->simpleNodeFinder = $simpleNodeFinder;
    }
    public function getType() : string
    {
        return ClassConstFetch::class;
    }
    /**
     * @param ClassConstFetch $expr
     * @return mixed
     */
    public function resolve(Expr $expr, string $currentFilePath)
    {
        $className = $this->simpleNameResolver->getName($expr->class);
        if ($className === 'self') {
            $classLike = $this->simpleNodeFinder->findFirstParentByType($expr, ClassLike::class);
            if (!$classLike instanceof ClassLike) {
                return null;
            }
            $className = $this->simpleNameResolver->getName($classLike);
        }
        if ($className === null) {
            return null;
        }
        $constantName = $this->simpleNameResolver->getName($expr->name);
        if ($constantName === null) {
            return null;
        }
        if ($constantName === 'class') {
            return $className;
        }
        if (!\class_exists($className) && !\interface_exists($className)) {
            return null;
        }
        $reflectionClassConstant = new ReflectionClassConstant($className, $constantName);
        return $reflectionClassConstant->getValue();
    }
}
