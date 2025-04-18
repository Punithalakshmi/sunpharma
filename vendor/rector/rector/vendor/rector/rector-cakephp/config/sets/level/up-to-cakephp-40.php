<?php

declare (strict_types=1);
namespace RectorPrefix20220609;

use Rector\CakePHP\Set\CakePHPLevelSetList;
use Rector\CakePHP\Set\CakePHPSetList;
use Rector\Config\RectorConfig;
return static function (RectorConfig $rectorConfig) : void {
    $rectorConfig->sets([CakePHPSetList::CAKEPHP_40, CakePHPLevelSetList::UP_TO_CAKEPHP_38]);
};
