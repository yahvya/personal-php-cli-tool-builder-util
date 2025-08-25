<?php

namespace Yahvya\PhpCliToolBuilder\Builder;

use Yahvya\PhpCliToolBuilder\Default\Command\HelpCommand;
use Yahvya\PhpCliToolBuilder\Default\Printer\ClassicPrinter;

/**
 * Cli tool configuration dto
 */
class CliToolConfiguration
{
    /**
     * @param string $toolName Tool name
     * @param string $toolDescription Tool description
     * @param string $toolVersion Tool current version
     * @param string $toolAuthor Tool author
     * @param CliCommand[] $commands Command instances
     * @param CliCommand|null $defaultCommand Default command to execute (requires a command with no arguments)
     * @param CliPrinter $printer Printer instance to use for the output
     * @param string $noCommandTypedMessage Message to display when no command has been typed
     * @param string $commandNotFoundMessage Message to display when the command is not found
     * @param string $argumentsExtractionRegex Regex to extract arguments from the command line. It is not recommended to modify this regex due to the inner result handler
     */
    public function __construct(
        public string      $toolName,
        public string      $toolDescription,
        public string      $toolVersion,
        public string      $toolAuthor,
        public array       $commands,
        public ?CliCommand $defaultCommand = new HelpCommand(),
        public CliPrinter  $printer = new ClassicPrinter(),
        public string      $noCommandTypedMessage = "> No command have been typed",
        public string      $commandNotFoundMessage = "> Command not found",
        public string      $argumentsExtractionRegex = "~\s(--[a-zA-Z0-9_-]+)([\s=]+((?:(?!\s--).)*))?~"
    )
    {
    }
}