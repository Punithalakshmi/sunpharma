<?php

declare (strict_types=1);
namespace RectorPrefix20220609\Symplify\AutowireArrayParameter\TypeResolver;

use RectorPrefix20220609\Nette\Utils\Reflection;
use ReflectionMethod;
use RectorPrefix20220609\Symplify\AutowireArrayParameter\DocBlock\ParamTypeDocBlockResolver;
final class ParameterTypeResolver
{
    /**
     * @var array<string, string>
     */
    private $resolvedParameterTypesCached = [];
    /**
     * @var \Symplify\AutowireArrayParameter\DocBlock\ParamTypeDocBlockResolver
     */
    private $paramTypeDocBlockResolver;
    public function __construct(ParamTypeDocBlockResolver $paramTypeDocBlockResolver)
    {
        $this->paramTypeDocBlockResolver = $paramTypeDocBlockResolver;
    }
    public function resolveParameterType(string $parameterName, ReflectionMethod $reflectionMethod) : ?string
    {
        $docComment = $reflectionMethod->getDocComment();
        if ($docComment === \false) {
            return null;
        }
        $declaringReflectionClass = $reflectionMethod->getDeclaringClass();
        $uniqueKey = $parameterName . $declaringReflectionClass->getName() . $reflectionMethod->getName();
        if (isset($this->resolvedParameterTypesCached[$uniqueKey])) {
            return $this->resolvedParameterTypesCached[$uniqueKey];
        }
        $resolvedType = $this->paramTypeDocBlockResolver->resolve($docComment, $parameterName);
        if ($resolvedType === null) {
            return null;
        }
        // not a class|interface type
        if (\ctype_lower($resolvedType[0])) {
            return null;
        }
        $resolvedClass = Reflection::expandClassName($resolvedType, $declaringReflectionClass);
        $this->resolvedParameterTypesCached[$uniqueKey] = $resolvedClass;
        return $resolvedClass;
    }
}
