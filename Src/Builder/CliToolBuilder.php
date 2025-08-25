<?php

namespace Yahvya\PhpCliToolBuilder\Builder;

use Exception;

/**
 * Cli tool builder class
 */
class CliToolBuilder
{
    /**
     * @param CliToolConfiguration $configuration CLI tool configuration
     */
    public function __construct(public CliToolConfiguration $configuration)
    {
    }

    /**
     * Treat the incoming command from the stream
     * @param string[] $cliArguments Command line arguments ($argv from the script entry)
     * @return bool Command execution success
     * @throws Exception In case of program error
     */
    public function treatInput(array $cliArguments): bool
    {
        $printer = $this->configuration->printer;
        $arguments = $this->getArgumentsFromCliArgs(cliArguments: $cliArguments);
        $commandName = $cliArguments[1] ?? "";

        if (!empty($commandName))
        {
            foreach ($this->configuration->commands as $command)
            {
                if (strcmp(string1: $commandName, string2: $command->getUniqueName()) !== 0)
                {
                    continue;
                }

                return $command->executeCommand(arguments: $arguments, associatedBuilder: $this);
            }

            $printer->printError(message: $this->configuration->commandNotFoundMessage);
            echo PHP_EOL . PHP_EOL;
        }
        else
        {
            $printer->printImportant(message: $this->configuration->noCommandTypedMessage);
            echo PHP_EOL . PHP_EOL;
        }

        return $this->configuration->defaultCommand?->executeCommand(arguments: [], associatedBuilder: $this) ?? false;
    }

    /**
     * Build argument instances from the command line arguments
     * @param array $cliArguments Command line arguments ($argv from the script entry)
     * @return CliArgument[] Built instances
     * @throws Exception On error
     */
    public function getArgumentsFromCliArgs(array $cliArguments): array
    {
        $commandLine = implode(separator: " ", array: $cliArguments);
        $matchSuccessState = @preg_match_all(
            pattern: $this->configuration->argumentsExtractionRegex,
            subject: $commandLine,
            matches: $matches,
        );

        if (
            !$matchSuccessState ||
            count(value: $matches) < 3
        )
        {
            return [];
        }

        $arguments = [];

        foreach ($matches[1] as $key => $value)
        {
            $argumentValue = substr(string: $matches[2][$key], offset: 1);

            $arguments[] = new CliArgument(
                argumentFullString: $matches[0][$key],
                argumentName: substr(string: $value, offset: 2),
                argumentValue: $argumentValue,
            );
        }

        return $arguments;
    }
}