<?php

use Yahvya\PhpCliToolBuilder\Builder\CliToolBuilder;
use Yahvya\PhpCliToolBuilder\Builder\CliToolConfiguration;
use Yahvya\PhpCliToolBuilder\Default\Command\HelpCommand;

require_once(__DIR__ . "/vendor/autoload.php");

$cliToolBuilder = new CliToolBuilder(
    configuration: new CliToolConfiguration(
        toolName: "eagle",
        toolDescription: "A tool to help you build your cli tool",
        toolVersion: "1.0.0",
        toolAuthor: "Yahvya",
        commands: [
            new HelpCommand()
        ]
    )
);

try
{
    $cliToolBuilder->treatInput(cliArguments: $argv);
}
catch (Exception $e)
{
    echo $e->getMessage();
}