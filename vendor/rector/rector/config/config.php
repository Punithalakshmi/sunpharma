<?php

declare (strict_types=1);
namespace RectorPrefix20220609;

use RectorPrefix20220609\Composer\Semver\VersionParser;
use RectorPrefix20220609\Doctrine\Inflector\Inflector;
use RectorPrefix20220609\Doctrine\Inflector\Rules\English\InflectorFactory;
use RectorPrefix20220609\OndraM\CiDetector\CiDetector;
use PhpParser\BuilderFactory;
use PhpParser\Lexer;
use PhpParser\NodeFinder;
use PhpParser\NodeVisitor\CloningVisitor;
use PhpParser\NodeVisitor\NodeConnectingVisitor;
use PHPStan\Analyser\NodeScopeResolver;
use PHPStan\Analyser\ScopeFactory;
use PHPStan\Dependency\DependencyResolver;
use PHPStan\File\FileHelper;
use PHPStan\Parser\Parser;
use PHPStan\PhpDoc\TypeNodeResolver;
use PHPStan\PhpDocParser\Parser\PhpDocParser;
use PHPStan\PhpDocParser\Parser\TypeParser;
use PHPStan\Reflection\ReflectionProvider;
use Rector\BetterPhpDocParser\PhpDocParser\BetterPhpDocParser;
use Rector\BetterPhpDocParser\PhpDocParser\BetterTypeParser;
use Rector\Caching\Cache;
use Rector\Caching\CacheFactory;
use Rector\Caching\ValueObject\Storage\MemoryCacheStorage;
use Rector\Config\RectorConfig;
use Rector\Core\Bootstrap\ExtensionConfigResolver;
use Rector\Core\Console\ConsoleApplication;
use Rector\Core\Console\Style\RectorConsoleOutputStyle;
use Rector\Core\Console\Style\RectorConsoleOutputStyleFactory;
use Rector\Core\Validation\Collector\EmptyConfigurableRectorCollector;
use Rector\NodeTypeResolver\DependencyInjection\PHPStanServicesFactory;
use Rector\NodeTypeResolver\Reflection\BetterReflection\SourceLocator\IntermediateSourceLocator;
use Rector\NodeTypeResolver\Reflection\BetterReflection\SourceLocatorProvider\DynamicSourceLocatorProvider;
use Rector\PSR4\Composer\PSR4NamespaceMatcher;
use Rector\PSR4\Contract\PSR4AutoloadNamespaceMatcherInterface;
use RectorPrefix20220609\Symfony\Component\Console\Application;
use function RectorPrefix20220609\Symfony\Component\DependencyInjection\Loader\Configurator\service;
use RectorPrefix20220609\Symplify\Astral\NodeTraverser\SimpleCallableNodeTraverser;
use RectorPrefix20220609\Symplify\EasyParallel\ValueObject\EasyParallelConfig;
use RectorPrefix20220609\Symplify\PackageBuilder\Parameter\ParameterProvider;
use RectorPrefix20220609\Symplify\PackageBuilder\Php\TypeChecker;
use RectorPrefix20220609\Symplify\PackageBuilder\Reflection\PrivatesAccessor;
use RectorPrefix20220609\Symplify\PackageBuilder\Reflection\PrivatesCaller;
use RectorPrefix20220609\Symplify\PackageBuilder\Yaml\ParametersMerger;
use RectorPrefix20220609\Symplify\SmartFileSystem\FileSystemFilter;
use RectorPrefix20220609\Symplify\SmartFileSystem\FileSystemGuard;
use RectorPrefix20220609\Symplify\SmartFileSystem\Finder\FinderSanitizer;
use RectorPrefix20220609\Symplify\SmartFileSystem\Json\JsonFileSystem;
use RectorPrefix20220609\Symplify\SmartFileSystem\SmartFileSystem;
return static function (RectorConfig $rectorConfig) : void {
    // make use of https://github.com/symplify/easy-parallel
    $rectorConfig->import(EasyParallelConfig::FILE_PATH);
    $rectorConfig->paths([]);
    $rectorConfig->skip([]);
    $rectorConfig->autoloadPaths([]);
    $rectorConfig->bootstrapFiles([]);
    $rectorConfig->parallel(120, 16, 20);
    $rectorConfig->disableImportNames();
    $rectorConfig->importShortClasses();
    $rectorConfig->indent(' ', 4);
    $rectorConfig->fileExtensions(['php']);
    $rectorConfig->nestedChainMethodCallLimit(60);
    $rectorConfig->cacheDirectory(\sys_get_temp_dir() . '/rector_cached_files');
    $services = $rectorConfig->services();
    $services->defaults()->public()->autowire()->autoconfigure();
    $services->load('Rector\\', __DIR__ . '/../packages')->exclude([
        __DIR__ . '/../packages/Config/RectorConfig.php',
        __DIR__ . '/../packages/*/{ValueObject,Contract,Exception}',
        __DIR__ . '/../packages/BetterPhpDocParser/PhpDocInfo/PhpDocInfo.php',
        __DIR__ . '/../packages/Testing/PHPUnit',
        __DIR__ . '/../packages/BetterPhpDocParser/PhpDoc',
        __DIR__ . '/../packages/PHPStanStaticTypeMapper/Enum',
        __DIR__ . '/../packages/Caching/Cache.php',
        __DIR__ . '/../packages/NodeTypeResolver/PhpDocNodeVisitor/UnderscoreRenamePhpDocNodeVisitor.php',
        // used in PHPStan
        __DIR__ . '/../packages/NodeTypeResolver/Reflection/BetterReflection/RectorBetterReflectionSourceLocatorFactory.php',
        __DIR__ . '/../packages/NodeTypeResolver/Reflection/BetterReflection/SourceLocatorProvider/DynamicSourceLocatorProvider.php',
    ]);
    // psr-4
    $services->alias(PSR4AutoloadNamespaceMatcherInterface::class, PSR4NamespaceMatcher::class);
    $services->load('Rector\\', __DIR__ . '/../rules')->exclude([__DIR__ . '/../rules/*/ValueObject/*', __DIR__ . '/../rules/*/Rector/*', __DIR__ . '/../rules/*/Contract/*', __DIR__ . '/../rules/*/Exception/*', __DIR__ . '/../rules/*/Enum/*', __DIR__ . '/../rules/DowngradePhp80/Reflection/SimplePhpParameterReflection.php']);
    // parallel
    $services->set(ParametersMerger::class);
    // use faster in-memory cache in CI.
    // CI always starts from scratch, therefore IO intensive caching is not worth it
    $ciDetector = new CiDetector();
    if ($ciDetector->isCiDetected()) {
        $rectorConfig->cacheClass(MemoryCacheStorage::class);
    }
    $extensionConfigResolver = new ExtensionConfigResolver();
    $extensionConfigFiles = $extensionConfigResolver->provide();
    foreach ($extensionConfigFiles as $extensionConfigFile) {
        $rectorConfig->import($extensionConfigFile->getRealPath());
    }
    // require only in dev
    $rectorConfig->import(__DIR__ . '/../utils/compiler/config/config.php', null, 'not_found');
    $services->load('Rector\\Core\\', __DIR__ . '/../src')->exclude([__DIR__ . '/../src/Rector', __DIR__ . '/../src/Console/Style/RectorConsoleOutputStyle.php', __DIR__ . '/../src/Exception', __DIR__ . '/../src/DependencyInjection/CompilerPass', __DIR__ . '/../src/DependencyInjection/Loader', __DIR__ . '/../src/Kernel', __DIR__ . '/../src/ValueObject', __DIR__ . '/../src/Bootstrap', __DIR__ . '/../src/Enum', __DIR__ . '/../src/PhpParser/Node/CustomNode', __DIR__ . '/../src/PhpParser/ValueObject', __DIR__ . '/../src/functions', __DIR__ . '/../src/constants.php']);
    $services->alias(Application::class, ConsoleApplication::class);
    $services->set(EmptyConfigurableRectorCollector::class)->arg('$containerBuilder', service('service_container'));
    $services->set(SimpleCallableNodeTraverser::class);
    $services->set(BuilderFactory::class);
    $services->set(CloningVisitor::class);
    $services->set(NodeConnectingVisitor::class);
    $services->set(NodeFinder::class);
    $services->set(RectorConsoleOutputStyle::class)->factory([service(RectorConsoleOutputStyleFactory::class), 'create']);
    $services->set(Parser::class)->factory([service(PHPStanServicesFactory::class), 'createPHPStanParser']);
    $services->set(Lexer::class)->factory([service(PHPStanServicesFactory::class), 'createEmulativeLexer']);
    // symplify/package-builder
    $services->set(FileSystemGuard::class);
    $services->set(PrivatesAccessor::class);
    $services->set(PrivatesCaller::class);
    $services->set(FinderSanitizer::class);
    $services->set(FileSystemFilter::class);
    $services->set(ParameterProvider::class)->arg('$container', service('service_container'));
    $services->set(SmartFileSystem::class);
    $services->set(JsonFileSystem::class);
    $services->set(InflectorFactory::class);
    $services->set(Inflector::class)->factory([service(InflectorFactory::class), 'build']);
    $services->set(VersionParser::class);
    $services->set(TypeChecker::class);
    // phpdoc parser
    $services->set(\PHPStan\PhpDocParser\Lexer\Lexer::class);
    $services->alias(PhpDocParser::class, BetterPhpDocParser::class);
    // cache
    $services->set(DependencyResolver::class)->factory([service(PHPStanServicesFactory::class), 'createDependencyResolver']);
    $services->set(FileHelper::class)->factory([service(PHPStanServicesFactory::class), 'createFileHelper']);
    $services->set(Cache::class)->factory([service(CacheFactory::class), 'create']);
    // type resolving
    $services->set(IntermediateSourceLocator::class);
    $services->alias(TypeParser::class, BetterTypeParser::class);
    // PHPStan services
    $services->set(ReflectionProvider::class)->factory([service(PHPStanServicesFactory::class), 'createReflectionProvider']);
    $services->set(NodeScopeResolver::class)->factory([service(PHPStanServicesFactory::class), 'createNodeScopeResolver']);
    $services->set(ScopeFactory::class)->factory([service(PHPStanServicesFactory::class), 'createScopeFactory']);
    $services->set(TypeNodeResolver::class)->factory([service(PHPStanServicesFactory::class), 'createTypeNodeResolver']);
    $services->set(DynamicSourceLocatorProvider::class)->factory([service(PHPStanServicesFactory::class), 'createDynamicSourceLocatorProvider']);
};
