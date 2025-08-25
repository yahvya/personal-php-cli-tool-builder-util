<?php

namespace Yahvya\PhpCliToolBuilder\Builder;

/**
 * Cli printer description
 */
interface CliPrinter
{
    public function printNormal(string $message): void;

    public function printSuccess(string $message): void;

    public function printError(string $message): void;

    public function printImportant(string $message): void;

    public function printLight(string $message): void;
}