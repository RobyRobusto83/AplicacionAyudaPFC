<?php

namespace App\Tests\Shared\infrastrucutre\Doctrine;

use App\Tests\Shared\infrastrucutre\PhpUnit\InfrastructureTestCase;
use Doctrine\ORM\EntityManagerInterface;

abstract class DoctrineBaseInfraestructureTestCase extends InfrastructureTestCase
{
    protected function em(): EntityManagerInterface
    {
        return $this->service(EntityManagerInterface::class);
    }

    protected function flush(): void
    {
        $this->em()->flush();
    }

    public function clearUnitOfWork(): void
    {
        $this->em()->clear();
    }
}