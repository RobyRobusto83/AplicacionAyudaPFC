<?php

namespace App\Tests\Pfc\application\UpdatePfc;

use App\Pfc\application\UpdatePfc\UpdatePfcApplication;
use App\Tests\Shared\domain\model\DocumentMother;
use PHPUnit\Framework\TestCase;
use App\Pfc\infrastructure\PfcRepository;
use App\Entity\Document;

final class UpdatePfcApplicationTest extends TestCase
{
    private $repository;

    /** @test */
    public function if_pfc_dont_exists_throw_exception(): void
    {
        $this->expectException(\Exception::class);
        $this->shouldNotExistPfc();
        $this->application()->execute(
            [
                "id" => "test",
                "title" => "TestTitle",
                "sections" => ""
            ]
        );
    }

    /** @test */
    public function if_pfc_exits_then_it_is_updated(): void
    {
        $this->shouldExistPfc();
        $this->shouldSaveDocument();
        $this->application()->execute(
            [
                "id" => "test",
                "title" => "TestTitle",
                "sections" => ""
            ]
        );
    }

    private function application(): UpdatePfcApplication
    {
        return new UpdatePfcApplication($this->repository());
    }

    private function repository(): PfcRepository
    {
        if (null === $this->repository) {
            $this->repository = $this->createMock(PfcRepository::class);
        }
        return $this->repository;
    }

    private function shouldExistPfc(): void
    {
        $this->repository()->expects($this->once())
            ->method('findByVersion')
            ->willReturn(DocumentMother::create());
    }

    private function shouldSaveDocument(): void
    {
        $this->repository()->expects($this->once())->method('add');
    }

    private function shouldNotExistPfc(): void
    {
        $this->repository()->expects($this->once())
            ->method('findByVersion')
            ->willReturn(null);
    }
}