<?php

namespace Yahvya\PhpCliToolBuilder\Default\Printer;

use Symfony\Component\Console\Output\ConsoleOutput;
use Yahvya\PhpCliToolBuilder\Builder\CliPrinter;

/**
 * Classic cli printer
 */
class ClassicPrinter implements CliPrinter
{
    /**
     * @var ConsoleOutput Console output manager
     */
    public ConsoleOutput $outputManager;

    public function __construct()
    {
        $this->outputManager = new ConsoleOutput();
    }

    public function printNormal(string $message): void
    {
        $this->outputManager->write(messages: $message);
    }

    public function printSuccess(string $message): void
    {
        $this->outputManager->write(messages: "<info>$message</info>");
    }

    public function printError(string $message): void
    {
        $this->outputManager->write(messages: "<error>$message</error>");
    }

    public function printImportant(string $message): void
    {
        $this->outputManager->write(messages: "<options=bold>$message</options=bold>");
    }

    public function printLight(string $message): void
    {
        $this->outputManager->write(messages: "<comment>$message</comment>");
    }
}