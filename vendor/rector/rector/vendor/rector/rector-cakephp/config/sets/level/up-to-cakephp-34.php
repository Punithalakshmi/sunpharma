<?php

declare (strict_types=1);
namespace RectorPrefix20220609;

use Rector\CakePHP\Set\CakePHPSetList;
use Rector\Config\RectorConfig;
return static function (RectorConfig $rectorConfig) : void {
    $rectorConfig->sets([CakePHPSetList::CAKEPHP_30, CakePHPSetList::CAKEPHP_34]);
};
