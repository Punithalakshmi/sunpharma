<?php

declare (strict_types=1);
namespace Rector\Nette\Latte\Parser;

use RectorPrefix20220609\Nette\Utils\Strings;
use Rector\Nette\ValueObject\LatteVariableType;
final class VarTypeParser
{
    /**
     * @var string
     * @see https://regex101.com/r/vYlxWm/1
     */
    private const VAR_TYPE_REGEX = '#{varType (?P<type>.*?) \\$(?P<variable>.*?)}#';
    /**
     * @return LatteVariableType[]
     */
    public function parse(string $content) : array
    {
        $matches = Strings::matchAll($content, self::VAR_TYPE_REGEX);
        $variableTypes = [];
        foreach ($matches as $match) {
            $variableTypes[] = new LatteVariableType($match['variable'], $match['type']);
        }
        return $variableTypes;
    }
}
