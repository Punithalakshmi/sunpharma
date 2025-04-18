<?php

declare (strict_types=1);
namespace Rector\Nette\ValueObject;

final class LatteVariableType
{
    /**
     * @readonly
     * @var string
     */
    private $name;
    /**
     * @readonly
     * @var string
     */
    private $type;
    public function __construct(string $name, string $type)
    {
        $this->name = $name;
        $this->type = $type;
    }
    public function getName() : string
    {
        return $this->name;
    }
    public function getType() : string
    {
        return $this->type;
    }
}
