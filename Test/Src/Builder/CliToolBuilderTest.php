<?php

namespace Src\Builder;

use Exception;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Yahvya\PhpCliToolBuilder\Builder\CliCommand;
use Yahvya\PhpCliToolBuilder\Builder\CliToolBuilder;
use Yahvya\PhpCliToolBuilder\Builder\CliToolConfiguration;

#[CoversClass(className: CliToolBuilder::class)]
#[CoversClass(className: CliToolConfiguration::class)]
#[TestDox(text: "Cli tool builder test")]
class CliToolBuilderTest extends TestCase
{
    #[TestDox(text: "Execute known command")]
    public function testExecuteKnownCommand(): void
    {
        try
        {
            $mockCommand = $this->createMock(type: CliCommand::class);
            $mockCommand->method(constraint: "getUniqueName")->willReturn(value: "demo");
            $mockCommand->method(constraint: "executeCommand")->willReturn(value: true);

            $config = new CliToolConfiguration(
                toolName: "Tool",
                toolDescription: "Test tool",
                toolVersion: "1.0",
                toolAuthor: "Test Author",
                commands: [$mockCommand]
            );

            $builder = new CliToolBuilder(configuration: $config);

            $result = $builder->treatInput(['cli.php', 'demo']);

            $this->assertTrue(condition: $result, message: "Command execution failed");
        }
        catch (Exception)
        {
            $this->fail(message: "An exception have been thrown");
        }
    }

    #[TestDox(text: "Execute known command")]
    public function testExecuteKnownCommandWithFalseResult(): void
    {
        try
        {
            $mockCommand = $this->createMock(type: CliCommand::class);
            $mockCommand->method(constraint: "getUniqueName")->willReturn(value: "demo");
            $mockCommand->method(constraint: "executeCommand")->willReturn(value: false);

            $config = new CliToolConfiguration(
                toolName: "Tool",
                toolDescription: "Test tool",
                toolVersion: "1.0",
                toolAuthor: "Test Author",
                commands: [$mockCommand]
            );

            $builder = new CliToolBuilder(configuration: $config);

            $result = $builder->treatInput(['cli.php', 'demo']);

            $this->assertFalse(condition: $result, message: "Command should fail");
        }
        catch (Exception)
        {
            $this->fail(message: "An exception have been thrown");
        }
    }
}