<?php

declare (strict_types=1);
namespace Rector\Core\PhpParser\Parser;

use PhpParser\Node\Stmt;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NodeConnectingVisitor;
use PhpParser\Parser;
use PhpParser\ParserFactory;
use RectorPrefix20220609\Symplify\SmartFileSystem\SmartFileSystem;
final class SimplePhpParser
{
    /**
     * @readonly
     * @var \PhpParser\Parser
     */
    private $phpParser;
    /**
     * @readonly
     * @var \Symplify\SmartFileSystem\SmartFileSystem
     */
    private $smartFileSystem;
    public function __construct(SmartFileSystem $smartFileSystem)
    {
        $this->smartFileSystem = $smartFileSystem;
        $parserFactory = new ParserFactory();
        $this->phpParser = $parserFactory->create(ParserFactory::PREFER_PHP7);
    }
    /**
     * @return Stmt[]
     */
    public function parseFile(string $filePath) : array
    {
        $fileContent = $this->smartFileSystem->readFile($filePath);
        return $this->parseString($fileContent);
    }
    /**
     * @return Stmt[]
     */
    public function parseString(string $fileContent) : array
    {
        $stmts = $this->phpParser->parse($fileContent);
        if ($stmts === null) {
            return [];
        }
        $nodeTraverser = new NodeTraverser();
        $nodeTraverser->addVisitor(new NodeConnectingVisitor());
        return $nodeTraverser->traverse($stmts);
    }
}
