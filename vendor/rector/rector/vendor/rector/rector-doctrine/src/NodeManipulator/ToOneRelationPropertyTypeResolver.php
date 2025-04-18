<?php

declare (strict_types=1);
namespace Rector\Doctrine\NodeManipulator;

use RectorPrefix20220609\Nette\Utils\Strings;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\ConstExpr\ConstExprTrueNode;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\PhpDocParser\ClassAnnotationMatcher;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;
use Rector\Doctrine\NodeAnalyzer\TargetEntityResolver;
use Rector\NodeTypeResolver\PHPStan\Type\TypeFactory;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;
final class ToOneRelationPropertyTypeResolver
{
    /**
     * @var class-string[]
     */
    private const TO_ONE_ANNOTATION_CLASSES = ['Doctrine\\ORM\\Mapping\\ManyToOne', 'Doctrine\\ORM\\Mapping\\OneToOne'];
    /**
     * @readonly
     * @var \Rector\NodeTypeResolver\PHPStan\Type\TypeFactory
     */
    private $typeFactory;
    /**
     * @readonly
     * @var \Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory
     */
    private $phpDocInfoFactory;
    /**
     * @readonly
     * @var \Rector\BetterPhpDocParser\PhpDocParser\ClassAnnotationMatcher
     */
    private $classAnnotationMatcher;
    /**
     * @readonly
     * @var \Rector\Doctrine\NodeAnalyzer\AttributeFinder
     */
    private $attributeFinder;
    /**
     * @readonly
     * @var \Rector\Doctrine\NodeAnalyzer\TargetEntityResolver
     */
    private $targetEntityResolver;
    public function __construct(TypeFactory $typeFactory, PhpDocInfoFactory $phpDocInfoFactory, ClassAnnotationMatcher $classAnnotationMatcher, AttributeFinder $attributeFinder, TargetEntityResolver $targetEntityResolver)
    {
        $this->typeFactory = $typeFactory;
        $this->phpDocInfoFactory = $phpDocInfoFactory;
        $this->classAnnotationMatcher = $classAnnotationMatcher;
        $this->attributeFinder = $attributeFinder;
        $this->targetEntityResolver = $targetEntityResolver;
    }
    public function resolve(Property $property) : ?Type
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);
        $doctrineAnnotationTagValueNode = $phpDocInfo->getByAnnotationClasses(self::TO_ONE_ANNOTATION_CLASSES);
        if ($doctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return $this->resolveFromDocBlock($phpDocInfo, $property, $doctrineAnnotationTagValueNode);
        }
        $targetEntity = $this->attributeFinder->findAttributeByClassesArgByName($property, self::TO_ONE_ANNOTATION_CLASSES, 'targetEntity');
        if (!$targetEntity instanceof Expr) {
            return null;
        }
        $targetEntityClass = $this->targetEntityResolver->resolveFromExpr($targetEntity);
        if ($targetEntityClass !== null) {
            $fullyQualifiedObjectType = new FullyQualifiedObjectType($targetEntityClass);
            // @todo resolve nullable value
            return $this->resolveFromObjectType($fullyQualifiedObjectType, \false);
        }
        return null;
    }
    private function processToOneRelation(Property $property, DoctrineAnnotationTagValueNode $toOneDoctrineAnnotationTagValueNode, ?DoctrineAnnotationTagValueNode $joinDoctrineAnnotationTagValueNode) : Type
    {
        $targetEntity = $toOneDoctrineAnnotationTagValueNode->getValueWithoutQuotes('targetEntity');
        if (!\is_string($targetEntity)) {
            return new MixedType();
        }
        if (\substr_compare($targetEntity, '::class', -\strlen('::class')) === 0) {
            $targetEntity = Strings::before($targetEntity, '::class');
        }
        // resolve to FQN
        $tagFullyQualifiedName = $this->classAnnotationMatcher->resolveTagFullyQualifiedName($targetEntity, $property);
        if ($tagFullyQualifiedName === null) {
            return new MixedType();
        }
        $fullyQualifiedObjectType = new FullyQualifiedObjectType($tagFullyQualifiedName);
        $isNullable = $this->isNullableType($joinDoctrineAnnotationTagValueNode);
        return $this->resolveFromObjectType($fullyQualifiedObjectType, $isNullable);
    }
    private function shouldAddNullType(DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode) : bool
    {
        $isNullableValue = $doctrineAnnotationTagValueNode->getValue('nullable');
        return $isNullableValue instanceof ConstExprTrueNode;
    }
    private function resolveFromDocBlock(PhpDocInfo $phpDocInfo, Property $property, DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode) : Type
    {
        $joinDoctrineAnnotationTagValueNode = $phpDocInfo->findOneByAnnotationClass('Doctrine\\ORM\\Mapping\\JoinColumn');
        return $this->processToOneRelation($property, $doctrineAnnotationTagValueNode, $joinDoctrineAnnotationTagValueNode);
    }
    private function resolveFromObjectType(FullyQualifiedObjectType $fullyQualifiedObjectType, bool $isNullable) : Type
    {
        $types = [];
        $types[] = $fullyQualifiedObjectType;
        if ($isNullable) {
            $types[] = new NullType();
        }
        $propertyType = $this->typeFactory->createMixedPassedOrUnionType($types);
        // add default null if missing
        if (!TypeCombinator::containsNull($propertyType)) {
            $propertyType = TypeCombinator::addNull($propertyType);
        }
        return $propertyType;
    }
    private function isNullableType(?DoctrineAnnotationTagValueNode $joinDoctrineAnnotationTagValueNode) : bool
    {
        if (!$joinDoctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return \false;
        }
        return $this->shouldAddNullType($joinDoctrineAnnotationTagValueNode);
    }
}
