<?php

declare (strict_types=1);
namespace Rector\NodeTypeResolver\TypeAnalyzer;

use PhpParser\Node;
use PHPStan\Type\ObjectType;
use Rector\NodeTypeResolver\NodeTypeCorrector\PregMatchTypeCorrector;
use Rector\NodeTypeResolver\NodeTypeResolver;
final class CountableTypeAnalyzer
{
    /**
     * @var ObjectType[]
     */
    private $countableObjectTypes = [];
    /**
     * @readonly
     * @var \Rector\NodeTypeResolver\TypeAnalyzer\ArrayTypeAnalyzer
     */
    private $arrayTypeAnalyzer;
    /**
     * @readonly
     * @var \Rector\NodeTypeResolver\NodeTypeResolver
     */
    private $nodeTypeResolver;
    /**
     * @readonly
     * @var \Rector\NodeTypeResolver\NodeTypeCorrector\PregMatchTypeCorrector
     */
    private $pregMatchTypeCorrector;
    public function __construct(\Rector\NodeTypeResolver\TypeAnalyzer\ArrayTypeAnalyzer $arrayTypeAnalyzer, NodeTypeResolver $nodeTypeResolver, PregMatchTypeCorrector $pregMatchTypeCorrector)
    {
        $this->arrayTypeAnalyzer = $arrayTypeAnalyzer;
        $this->nodeTypeResolver = $nodeTypeResolver;
        $this->pregMatchTypeCorrector = $pregMatchTypeCorrector;
        $this->countableObjectTypes = [new ObjectType('Countable'), new ObjectType('SimpleXMLElement'), new ObjectType('ResourceBundle')];
    }
    public function isCountableType(Node $node) : bool
    {
        $nodeType = $this->nodeTypeResolver->getType($node);
        $nodeType = $this->pregMatchTypeCorrector->correct($node, $nodeType);
        foreach ($this->countableObjectTypes as $countableObjectType) {
            if ($countableObjectType->isSuperTypeOf($nodeType)->yes()) {
                return \true;
            }
        }
        return $this->arrayTypeAnalyzer->isArrayType($node);
    }
}
