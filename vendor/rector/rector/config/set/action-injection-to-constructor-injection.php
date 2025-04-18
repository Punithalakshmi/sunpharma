<?php

declare (strict_types=1);
namespace RectorPrefix20220609;

use Rector\Config\RectorConfig;
use Rector\DependencyInjection\Rector\Class_\ActionInjectionToConstructorInjectionRector;
return static function (RectorConfig $rectorConfig) : void {
    $rectorConfig->rule(ActionInjectionToConstructorInjectionRector::class);
};
