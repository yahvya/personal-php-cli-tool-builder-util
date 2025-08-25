<?php

namespace Test;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(className: Test::class)]
class Test extends TestCase
{
    public final function testTheFunction(): void
    {
        $this->assertTrue(true);
    }
}