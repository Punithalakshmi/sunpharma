<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace RectorPrefix20220609\Symfony\Component\Console\Style;

use RectorPrefix20220609\Symfony\Component\Console\Formatter\OutputFormatterInterface;
use RectorPrefix20220609\Symfony\Component\Console\Helper\ProgressBar;
use RectorPrefix20220609\Symfony\Component\Console\Output\ConsoleOutputInterface;
use RectorPrefix20220609\Symfony\Component\Console\Output\OutputInterface;
/**
 * Decorates output to add console style guide helpers.
 *
 * @author Kevin Bond <kevinbond@gmail.com>
 */
abstract class OutputStyle implements OutputInterface, StyleInterface
{
    /**
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    private $output;
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }
    /**
     * {@inheritdoc}
     */
    public function newLine(int $count = 1)
    {
        $this->output->write(\str_repeat(\PHP_EOL, $count));
    }
    public function createProgressBar(int $max = 0) : ProgressBar
    {
        return new ProgressBar($this->output, $max);
    }
    /**
     * {@inheritdoc}
     * @param string|mixed[] $messages
     */
    public function write($messages, bool $newline = \false, int $type = self::OUTPUT_NORMAL)
    {
        $this->output->write($messages, $newline, $type);
    }
    /**
     * {@inheritdoc}
     * @param string|mixed[] $messages
     */
    public function writeln($messages, int $type = self::OUTPUT_NORMAL)
    {
        $this->output->writeln($messages, $type);
    }
    /**
     * {@inheritdoc}
     */
    public function setVerbosity(int $level)
    {
        $this->output->setVerbosity($level);
    }
    /**
     * {@inheritdoc}
     */
    public function getVerbosity() : int
    {
        return $this->output->getVerbosity();
    }
    /**
     * {@inheritdoc}
     */
    public function setDecorated(bool $decorated)
    {
        $this->output->setDecorated($decorated);
    }
    /**
     * {@inheritdoc}
     */
    public function isDecorated() : bool
    {
        return $this->output->isDecorated();
    }
    /**
     * {@inheritdoc}
     */
    public function setFormatter(OutputFormatterInterface $formatter)
    {
        $this->output->setFormatter($formatter);
    }
    /**
     * {@inheritdoc}
     */
    public function getFormatter() : OutputFormatterInterface
    {
        return $this->output->getFormatter();
    }
    /**
     * {@inheritdoc}
     */
    public function isQuiet() : bool
    {
        return $this->output->isQuiet();
    }
    /**
     * {@inheritdoc}
     */
    public function isVerbose() : bool
    {
        return $this->output->isVerbose();
    }
    /**
     * {@inheritdoc}
     */
    public function isVeryVerbose() : bool
    {
        return $this->output->isVeryVerbose();
    }
    /**
     * {@inheritdoc}
     */
    public function isDebug() : bool
    {
        return $this->output->isDebug();
    }
    protected function getErrorOutput()
    {
        if (!$this->output instanceof ConsoleOutputInterface) {
            return $this->output;
        }
        return $this->output->getErrorOutput();
    }
}
