<?php

declare (strict_types=1);
namespace Rector\Core\Config\Loader;

use Rector\Core\DependencyInjection\Collector\ConfigureCallValuesCollector;
use Rector\Core\DependencyInjection\Loader\ConfigurableCallValuesCollectingPhpFileLoader;
use RectorPrefix20220609\Symfony\Component\Config\FileLocator;
use RectorPrefix20220609\Symfony\Component\Config\Loader\DelegatingLoader;
use RectorPrefix20220609\Symfony\Component\Config\Loader\GlobFileLoader;
use RectorPrefix20220609\Symfony\Component\Config\Loader\LoaderInterface;
use RectorPrefix20220609\Symfony\Component\Config\Loader\LoaderResolver;
use RectorPrefix20220609\Symfony\Component\DependencyInjection\ContainerBuilder;
use RectorPrefix20220609\Symplify\SymplifyKernel\Contract\Config\LoaderFactoryInterface;
final class ConfigureCallMergingLoaderFactory implements LoaderFactoryInterface
{
    /**
     * @readonly
     * @var \Rector\Core\DependencyInjection\Collector\ConfigureCallValuesCollector
     */
    private $configureCallValuesCollector;
    public function __construct(ConfigureCallValuesCollector $configureCallValuesCollector)
    {
        $this->configureCallValuesCollector = $configureCallValuesCollector;
    }
    public function create(ContainerBuilder $containerBuilder, string $currentWorkingDirectory) : LoaderInterface
    {
        $fileLocator = new FileLocator([$currentWorkingDirectory]);
        $loaderResolver = new LoaderResolver([new GlobFileLoader($fileLocator), new ConfigurableCallValuesCollectingPhpFileLoader($containerBuilder, $fileLocator, $this->configureCallValuesCollector)]);
        return new DelegatingLoader($loaderResolver);
    }
}
