<?php

namespace Test\Src\Power;

use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Yahvya\PhpCliToolBuilder\Builder\CliArgument;
use Yahvya\PhpCliToolBuilder\Power\SearchArgumentPower;

#[CoversTrait(traitName: SearchArgumentPower::class)]
#[TestDox(text: "Search argument power test")]
class SearchArgumentPowerTest extends TestCase
{
    use SearchArgumentPower;

    public static function provideSearchArgumentWithNameTestMethodData(): array
    {
        $arguments = [
            new CliArgument(argumentFullString: "don't matter", argumentName: "argument1", argumentValue: "argument1Value"),
            new CliArgument(argumentFullString: "don't matter", argumentName: "argument2", argumentValue: "argument2Value"),
            new CliArgument(argumentFullString: "don't matter", argumentName: "argument3", argumentValue: "argument3Value"),
            new CliArgument(argumentFullString: "don't matter", argumentName: "argument4", argumentValue: "argument4Value"),
            new CliArgument(argumentFullString: "don't matter", argumentName: "argument5", argumentValue: "argument5Value"),
        ];

        return [
            ["argument1", $arguments, $arguments[0]],
            ["argument3", $arguments, $arguments[2]],
            ["not exist", $arguments, null]
        ];
    }

    #[TestDox(text: "Search argument with name provide the expected value")]
    #[DataProvider(methodName: "provideSearchArgumentWithNameTestMethodData")]
    public function testSearchArgumentWithNameProvideTheExpectedValue(string $argumentName, array $arguments, ?CliArgument $expected): void
    {
        $result = $this->searchArgumentWithName(argumentName: $argumentName, arguments: $arguments);

        $this->assertSame(expected: $expected, actual: $result, message: "The founded element is not the expected one");
    }
}