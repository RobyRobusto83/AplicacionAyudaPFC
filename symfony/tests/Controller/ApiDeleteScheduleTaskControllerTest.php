<?php 

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ApiDeleteSheduleTaskControllerTest extends TestCase
{
    /** @test */
    public function pushAndPop(): void
    {
        $stack = [];
        $this->assertSame(0, count($stack));

        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1]);
        $this->assertSame(1, count($stack));

        $this->assertSame('foo', array_pop($stack));
        $this->assertSame(0, count($stack));
    }

    /** @test */
    public function fallando(): void
    {
        $this->assertTrue(true);
    }
}