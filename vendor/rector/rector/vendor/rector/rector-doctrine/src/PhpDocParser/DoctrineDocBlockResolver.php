<?php

declare (strict_types=1);
namespace Rector\Doctrine\PhpDocParser;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Core\PhpParser\Node\BetterNodeFinder;
use Rector\Doctrine\PhpDoc\ShortClassExpander;
final class DoctrineDocBlockResolver
{
    /**
     * @readonly
     * @var \Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory
     */
    private $phpDocInfoFactory;
    /**
     * @readonly
     * @var \Rector\Doctrine\PhpDoc\ShortClassExpander
     */
    private $shortClassExpander;
    /**
     * @readonly
     * @var \Rector\Core\PhpParser\Node\BetterNodeFinder
     */
    private $betterNodeFinder;
    public function __construct(PhpDocInfoFactory $phpDocInfoFactory, ShortClassExpander $shortClassExpander, BetterNodeFinder $betterNodeFinder)
    {
        $this->phpDocInfoFactory = $phpDocInfoFactory;
        $this->shortClassExpander = $shortClassExpander;
        $this->betterNodeFinder = $betterNodeFinder;
    }
    public function isDoctrineEntityClass(Class_ $class) : bool
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($class);
        return $phpDocInfo->hasByAnnotationClasses(['Doctrine\\ORM\\Mapping\\Entity', 'Doctrine\\ORM\\Mapping\\Embeddable']);
    }
    public function getTargetEntity(Property $property) : ?string
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);
        $doctrineAnnotationTagValueNode = $phpDocInfo->getByAnnotationClasses(['Doctrine\\ORM\\Mapping\\OneToMany', 'Doctrine\\ORM\\Mapping\\ManyToMany', 'Doctrine\\ORM\\Mapping\\OneToOne', 'Doctrine\\ORM\\Mapping\\ManyToOne']);
        if (!$doctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return null;
        }
        $targetEntity = $doctrineAnnotationTagValueNode->getValue('targetEntity');
        if (!\is_string($targetEntity)) {
            return null;
        }
        return $this->shortClassExpander->resolveFqnTargetEntity($targetEntity, $property);
    }
    public function isInDoctrineEntityClass(Node $node) : bool
    {
        $class = $this->betterNodeFinder->findParentType($node, Class_::class);
        if (!$class instanceof Class_) {
            return \false;
        }
        return $this->isDoctrineEntityClass($class);
    }
}
