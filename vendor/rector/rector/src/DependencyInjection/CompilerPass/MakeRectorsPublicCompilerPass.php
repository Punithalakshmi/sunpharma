<?php

declare (strict_types=1);
namespace Rector\Core\DependencyInjection\CompilerPass;

use Rector\Core\Contract\Rector\RectorInterface;
use RectorPrefix20220609\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use RectorPrefix20220609\Symfony\Component\DependencyInjection\ContainerBuilder;
final class MakeRectorsPublicCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $containerBuilder) : void
    {
        foreach ($containerBuilder->getDefinitions() as $definition) {
            if ($definition->getClass() === null) {
                continue;
            }
            if (!\is_a($definition->getClass(), RectorInterface::class, \true)) {
                continue;
            }
            $definition->setPublic(\true);
        }
    }
}
