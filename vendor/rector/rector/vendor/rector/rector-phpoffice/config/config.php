<?php

declare (strict_types=1);
namespace RectorPrefix20220609;

use Rector\Config\RectorConfig;
return static function (RectorConfig $rectorConfig) : void {
    $services = $rectorConfig->services();
    $services->defaults()->public()->autowire()->autoconfigure();
    $services->load('Rector\\PHPOffice\\', __DIR__ . '/../src')->exclude([__DIR__ . '/../src/Set', __DIR__ . '/../src/Rector', __DIR__ . '/../src/ValueObject']);
};
