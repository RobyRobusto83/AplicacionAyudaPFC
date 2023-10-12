<?php

namespace App\Tests\Shared\infrastrucutre\PhpUnit;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class InfrastructureTestCase extends KernelTestCase
{
    protected function setUp(): void
    {
        self::bootKernel([
            'environment' => 'test',
            'debug' => false,
        ]);

        parent::setUp();
    }

    protected function service(string $id): mixed
    {
        return static::getContainer()->get($id);
    }
}