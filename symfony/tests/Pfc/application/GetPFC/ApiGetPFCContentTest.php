<?php

namespace App\Tests\Pfc\application\GetPFC;

use App\Pfc\application\GetPFC\ApiGetPFCContent;
use App\Tests\Shared\domain\model\DocumentMother;
use PHPUnit\Framework\TestCase;
use App\Pfc\infrastructure\PfcRepository;

class ApiGetPFCContentTest extends TestCase
{

    private $repository;

    /** @test */
    public function if_content_dont_exists_throw_exception(): void
    {
        $this->expectException(\Exception::class);
        $this->shouldNotExistContent();
        $this->application()->execute("MiPfc");
    }

    /** @test */
    public function if_pfc_exits_then_it_is_return(): void
    {
        $this->shouldExistPfc();
        $target = $this->application()->execute("");
        $this->assertNotNull($target);
        $this->assertEquals("Titulo PFC", $target["title"]);
        $this->assertNull($target["sections"]);
    }

    private function application(): ApiGetPFCContent
    {
        return new ApiGetPFCContent($this->repository());
    }

    private function shouldExistPfc(): void
    {
        $this->repository()->expects($this->once())
            ->method('findByVersion')
            ->willReturn(DocumentMother::create());
    }

    private function repository(): PfcRepository
    {
        if (null === $this->repository) {
            $this->repository = $this->createMock(PfcRepository::class);
        }
        return $this->repository;
    }

    private function shouldNotExistContent(): void
    {
        $this->repository()
            ->method('findByUuid')
            ->willReturn(null);
    }
}
