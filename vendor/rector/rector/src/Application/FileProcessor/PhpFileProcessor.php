<?php

declare (strict_types=1);
namespace Rector\Core\Application\FileProcessor;

use PHPStan\AnalysedCodeException;
use Rector\ChangesReporting\ValueObjectFactory\ErrorFactory;
use Rector\Core\Application\FileDecorator\FileDiffFileDecorator;
use Rector\Core\Application\FileProcessor;
use Rector\Core\Application\FileSystem\RemovedAndAddedFilesCollector;
use Rector\Core\Contract\Console\OutputStyleInterface;
use Rector\Core\Contract\Processor\FileProcessorInterface;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\PhpParser\Printer\FormatPerservingPrinter;
use Rector\Core\Provider\CurrentFileProvider;
use Rector\Core\ValueObject\Application\File;
use Rector\Core\ValueObject\Configuration;
use Rector\Core\ValueObject\Error\SystemError;
use Rector\Core\ValueObject\Reporting\FileDiff;
use Rector\Parallel\ValueObject\Bridge;
use Rector\PostRector\Application\PostFileProcessor;
use Rector\Testing\PHPUnit\StaticPHPUnitEnvironment;
use Throwable;
final class PhpFileProcessor implements FileProcessorInterface
{
    /**
     * @readonly
     * @var \Rector\Core\PhpParser\Printer\FormatPerservingPrinter
     */
    private $formatPerservingPrinter;
    /**
     * @readonly
     * @var \Rector\Core\Application\FileProcessor
     */
    private $fileProcessor;
    /**
     * @readonly
     * @var \Rector\Core\Application\FileSystem\RemovedAndAddedFilesCollector
     */
    private $removedAndAddedFilesCollector;
    /**
     * @readonly
     * @var \Rector\Core\Contract\Console\OutputStyleInterface
     */
    private $rectorOutputStyle;
    /**
     * @readonly
     * @var \Rector\Core\Application\FileDecorator\FileDiffFileDecorator
     */
    private $fileDiffFileDecorator;
    /**
     * @readonly
     * @var \Rector\Core\Provider\CurrentFileProvider
     */
    private $currentFileProvider;
    /**
     * @readonly
     * @var \Rector\PostRector\Application\PostFileProcessor
     */
    private $postFileProcessor;
    /**
     * @readonly
     * @var \Rector\ChangesReporting\ValueObjectFactory\ErrorFactory
     */
    private $errorFactory;
    public function __construct(FormatPerservingPrinter $formatPerservingPrinter, FileProcessor $fileProcessor, RemovedAndAddedFilesCollector $removedAndAddedFilesCollector, OutputStyleInterface $rectorOutputStyle, FileDiffFileDecorator $fileDiffFileDecorator, CurrentFileProvider $currentFileProvider, PostFileProcessor $postFileProcessor, ErrorFactory $errorFactory)
    {
        $this->formatPerservingPrinter = $formatPerservingPrinter;
        $this->fileProcessor = $fileProcessor;
        $this->removedAndAddedFilesCollector = $removedAndAddedFilesCollector;
        $this->rectorOutputStyle = $rectorOutputStyle;
        $this->fileDiffFileDecorator = $fileDiffFileDecorator;
        $this->currentFileProvider = $currentFileProvider;
        $this->postFileProcessor = $postFileProcessor;
        $this->errorFactory = $errorFactory;
    }
    /**
     * @return array{system_errors: SystemError[], file_diffs: FileDiff[]}
     */
    public function process(File $file, Configuration $configuration) : array
    {
        $systemErrorsAndFileDiffs = [Bridge::SYSTEM_ERRORS => [], Bridge::FILE_DIFFS => []];
        // 1. parse files to nodes
        $parsingSystemErrors = $this->parseFileAndDecorateNodes($file);
        if ($parsingSystemErrors !== []) {
            // we cannot process this file as the parsing and type resolving itself went wrong
            $systemErrorsAndFileDiffs[Bridge::SYSTEM_ERRORS] = $parsingSystemErrors;
            return $systemErrorsAndFileDiffs;
        }
        // 2. change nodes with Rectors
        do {
            $file->changeHasChanged(\false);
            $this->refactorNodesWithRectors($file, $configuration);
            // 3. apply post rectors
            $newStmts = $this->postFileProcessor->traverse($file->getNewStmts());
            // this is needed for new tokens added in "afterTraverse()"
            $file->changeNewStmts($newStmts);
            // 4. print to file or string
            $this->currentFileProvider->setFile($file);
            // important to detect if file has changed
            $this->printFile($file, $configuration);
        } while ($file->hasChanged());
        // return json here
        $fileDiff = $file->getFileDiff();
        if (!$fileDiff instanceof FileDiff) {
            return $systemErrorsAndFileDiffs;
        }
        $systemErrorsAndFileDiffs[Bridge::FILE_DIFFS] = [$fileDiff];
        return $systemErrorsAndFileDiffs;
    }
    public function supports(File $file, Configuration $configuration) : bool
    {
        $smartFileInfo = $file->getSmartFileInfo();
        return $smartFileInfo->hasSuffixes($configuration->getFileExtensions());
    }
    /**
     * @return string[]
     */
    public function getSupportedFileExtensions() : array
    {
        return ['php'];
    }
    private function refactorNodesWithRectors(File $file, Configuration $configuration) : void
    {
        $this->currentFileProvider->setFile($file);
        $this->fileProcessor->refactor($file, $configuration);
    }
    /**
     * @return SystemError[]
     */
    private function parseFileAndDecorateNodes(File $file) : array
    {
        $this->currentFileProvider->setFile($file);
        $this->notifyFile($file);
        try {
            $this->fileProcessor->parseFileInfoToLocalCache($file);
        } catch (ShouldNotHappenException $shouldNotHappenException) {
            throw $shouldNotHappenException;
        } catch (AnalysedCodeException $analysedCodeException) {
            // inform about missing classes in tests
            if (StaticPHPUnitEnvironment::isPHPUnitRun()) {
                throw $analysedCodeException;
            }
            $autoloadSystemError = $this->errorFactory->createAutoloadError($analysedCodeException, $file->getSmartFileInfo());
            return [$autoloadSystemError];
        } catch (Throwable $throwable) {
            if ($this->rectorOutputStyle->isVerbose() || StaticPHPUnitEnvironment::isPHPUnitRun()) {
                throw $throwable;
            }
            $systemError = new SystemError($throwable->getMessage(), $file->getRelativeFilePath(), $throwable->getLine());
            return [$systemError];
        }
        return [];
    }
    private function printFile(File $file, Configuration $configuration) : void
    {
        $smartFileInfo = $file->getSmartFileInfo();
        if ($this->removedAndAddedFilesCollector->isFileRemoved($smartFileInfo)) {
            // skip, because this file exists no more
            return;
        }
        $newContent = $configuration->isDryRun() ? $this->formatPerservingPrinter->printParsedStmstAndTokensToString($file) : $this->formatPerservingPrinter->printParsedStmstAndTokens($file);
        $file->changeFileContent($newContent);
        $this->fileDiffFileDecorator->decorate([$file]);
    }
    private function notifyFile(File $file) : void
    {
        if (!$this->rectorOutputStyle->isVerbose()) {
            return;
        }
        $smartFileInfo = $file->getSmartFileInfo();
        $relativeFilePath = $smartFileInfo->getRelativeFilePathFromDirectory(\getcwd());
        $message = $relativeFilePath;
        $this->rectorOutputStyle->writeln($message);
    }
}
