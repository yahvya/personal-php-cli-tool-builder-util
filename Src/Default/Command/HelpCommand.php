<?php

namespace Yahvya\PhpCliToolBuilder\Default\Command;

use Symfony\Component\Console\Helper\Table;
use Yahvya\PhpCliToolBuilder\Builder\CliCommand;
use Yahvya\PhpCliToolBuilder\Builder\CliToolBuilder;
use Yahvya\PhpCliToolBuilder\Power\SearchArgumentPower;

/**
 * Default help command
 */
class HelpCommand implements CliCommand
{
    use SearchArgumentPower;

    public function getUniqueName(): string
    {
        return "help";
    }

    public function getOptionsDescriptions(): array
    {
        return [
            "command" => "Optional, this option allows you to display the help of a specific command"
        ];
    }

    public function getHelpLine(CliToolBuilder $associatedBuilder): string
    {
        return "[help] This command displays the help of a specific command or each commands";
    }

    public function executeCommand(array $arguments, CliToolBuilder $associatedBuilder): bool
    {
        $commandsMap = [];

        foreach ($associatedBuilder->configuration->commands as $command)
        {
            $commandsMap[$command->getUniqueName()] = $command;
        }

        $commandNameArgument = $this->searchArgumentWithName(argumentName: "command", arguments: $arguments);

        $commandsToPrint = array_key_exists(key: $commandNameArgument?->argumentName, array: $commandsMap) ?
            [$commandsMap[$commandNameArgument->argumentName]] : $commandsMap;

        $this->printCommandsList(commands: $commandsToPrint, associatedBuilder: $associatedBuilder);

        return true;
    }

    /**
     * Print a list of commands help
     * @param array $commands Commands to print helps
     * @param CliToolBuilder $associatedBuilder Associated builder
     * @return void
     */
    public function printCommandsList(array $commands, CliToolBuilder $associatedBuilder): void
    {
        foreach ($commands as $command)
        {
            $command->getHelpLine(associatedBuilder: $associatedBuilder);

            $optionRows = [];

            foreach ($command->getOptionsDescriptions() as $optionName => $optionDescription)
            {
                $optionRows[] = ["$optionName", $optionDescription];
            }

            $tablePrinter = new Table(output: $associatedBuilder->configuration->printer->outputManager);
            $tablePrinter->setHeaderTitle(title: $command->getHelpLine(associatedBuilder: $associatedBuilder));

            if (empty($optionRows))
            {
                $tablePrinter->setHeaders(headers: ["This command does not have any options"]);
            }
            else
            {
                $tablePrinter->setHeaders(headers: ["Option name (to type with -- as the prefix)", "Description"]);
            }

            $tablePrinter->setRows(rows: $optionRows);

            echo PHP_EOL;
            $tablePrinter->render();
            echo PHP_EOL;
        }
    }
}