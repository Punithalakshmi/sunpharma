<?php

declare (strict_types=1);
namespace RectorPrefix20220609\Symplify\PackageBuilder\Console\Input;

use RectorPrefix20220609\Symfony\Component\Console\Input\ArgvInput;
/**
 * @api
 */
final class StaticInputDetector
{
    public static function isDebug() : bool
    {
        $argvInput = new ArgvInput();
        return $argvInput->hasParameterOption(['--debug', '-v', '-vv', '-vvv']);
    }
}
