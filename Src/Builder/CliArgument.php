<?php

namespace Yahvya\PhpCliToolBuilder\Builder;

/**
 * Cli argument
 */
class CliArgument
{
    /**
     * @param string $argumentFullString Provided input string
     * @param string $argumentName Argument extracted name
     * @param string|null $argumentValue Argument extracted value
     */
    public function __construct(
        public string  $argumentFullString,
        public string  $argumentName,
        public ?string $argumentValue
    )
    {
    }
}