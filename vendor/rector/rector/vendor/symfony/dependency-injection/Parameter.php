<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace RectorPrefix20220609\Symfony\Component\DependencyInjection;

/**
 * Parameter represents a parameter reference.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Parameter
{
    /**
     * @var string
     */
    private $id;
    public function __construct(string $id)
    {
        $this->id = $id;
    }
    public function __toString() : string
    {
        return $this->id;
    }
}
