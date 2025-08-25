<?php

namespace Yahvya\PhpCliToolBuilder\Builder;

/**
 * Cli command definition
 */
interface CliCommand
{
    /**
     * @return string The unique name of the command
     */
    public function getUniqueName(): string;

    /**
     * @return array{string:string} The options descriptions (option name as the key and the description as the value)
     */
    public function getOptionsDescriptions(): array;

    /**
     * Print the help lines for the command. It should end which a line break
     * @param CliToolBuilder $associatedBuilder Associated builder
     * @return string Title line
     */
    public function displayHelpLine(CliToolBuilder $associatedBuilder): string;

    /**
     * Execute the command
     * @param CliArgument[] $arguments Passed arguments
     * @param CliToolBuilder $associatedBuilder The associated builder
     * @return bool Command execution success state
     */
    public function executeCommand(array $arguments, CliToolBuilder $associatedBuilder): bool;
}