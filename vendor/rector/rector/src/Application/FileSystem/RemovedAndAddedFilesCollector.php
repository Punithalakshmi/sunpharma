<?php

declare (strict_types=1);
namespace Rector\Core\Application\FileSystem;

use Rector\Core\ValueObject\Application\File;
use Rector\Core\ValueObject\Application\MovedFile;
use Rector\FileSystemRector\Contract\AddedFileInterface;
use Rector\FileSystemRector\ValueObject\AddedFileWithContent;
use Rector\FileSystemRector\ValueObject\AddedFileWithNodes;
use RectorPrefix20220609\Symplify\SmartFileSystem\SmartFileInfo;
final class RemovedAndAddedFilesCollector
{
    /**
     * @var SmartFileInfo[]
     */
    private $removedFileInfos = [];
    /**
     * @var AddedFileInterface[]
     */
    private $addedFiles = [];
    /**
     * @var MovedFile[]
     */
    private $movedFiles = [];
    public function removeFile(SmartFileInfo $smartFileInfo) : void
    {
        $this->removedFileInfos[] = $smartFileInfo;
    }
    /**
     * @return SmartFileInfo[]
     */
    public function getRemovedFiles() : array
    {
        return $this->removedFileInfos;
    }
    public function isFileRemoved(SmartFileInfo $smartFileInfo) : bool
    {
        // early assign to variable for increase performance
        // @see https://3v4l.org/FM3vY#focus=8.0.7 vs https://3v4l.org/JZW7b#focus=8.0.7
        $pathname = $smartFileInfo->getPathname();
        foreach ($this->removedFileInfos as $removedFileInfo) {
            if ($removedFileInfo->getPathname() !== $pathname) {
                continue;
            }
            return \true;
        }
        foreach ($this->movedFiles as $movedFile) {
            $file = $movedFile->getFile();
            $fileInfo = $file->getSmartFileInfo();
            if ($fileInfo->getPathname() !== $pathname) {
                continue;
            }
            return \true;
        }
        return \false;
    }
    public function addAddedFile(AddedFileInterface $addedFile) : void
    {
        $this->addedFiles[] = $addedFile;
    }
    /**
     * @return AddedFileWithContent[]
     */
    public function getAddedFilesWithContent() : array
    {
        return \array_filter($this->addedFiles, function (AddedFileInterface $addedFile) : bool {
            return $addedFile instanceof AddedFileWithContent;
        });
    }
    /**
     * @return AddedFileWithNodes[]
     */
    public function getAddedFilesWithNodes() : array
    {
        return \array_filter($this->addedFiles, function (AddedFileInterface $addedFile) : bool {
            return $addedFile instanceof AddedFileWithNodes;
        });
    }
    public function getAffectedFilesCount() : int
    {
        return \count($this->addedFiles) + \count($this->removedFileInfos);
    }
    public function getAddedFileCount() : int
    {
        return \count($this->addedFiles);
    }
    public function getRemovedFilesCount() : int
    {
        return \count($this->removedFileInfos);
    }
    /**
     * For testing
     */
    public function reset() : void
    {
        $this->addedFiles = [];
        $this->movedFiles = [];
        $this->removedFileInfos = [];
    }
    public function addMovedFile(File $file, string $newPathName) : void
    {
        $this->movedFiles[] = new MovedFile($file, $newPathName);
    }
    /**
     * @return MovedFile[]
     */
    public function getMovedFiles() : array
    {
        return $this->movedFiles;
    }
}
