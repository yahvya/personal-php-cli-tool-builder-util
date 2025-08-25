<?php

namespace Yahvya\PhpCliToolBuilder\Power;

use Yahvya\PhpCliToolBuilder\Builder\CliArgument;

/**
 * Add the utilities to search between arguments
 */
trait SearchArgumentPower
{
    /**
     * Search an argument by its name
     * @param string $argumentName Argument name to search (without --)
     * @param array $arguments Arguments to search in
     * @return CliArgument|null Founded argument or null if not found
     */
    public function searchArgumentWithName(string $argumentName, array $arguments): ?CliArgument
    {
        foreach ($arguments as $argument)
        {
            if (strcmp(string1: $argument->argumentName, string2: $argumentName) === 0)
            {
                return $argument;
            }
        }

        return null;
    }
}