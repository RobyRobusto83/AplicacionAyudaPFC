<?php

namespace App\Tests\integration\Pfc\application\GetPFC;

use App\Pfc\application\GetPFC\ApiGetPFCContent;
use App\Pfc\application\NewPfc\NewPfcApplication;
use App\Pfc\infrastructure\PfcRepository;
use App\Tests\Shared\domain\model\DocumentMother;
use App\Tests\Shared\infrastrucutre\Doctrine\DoctrineBaseInfraestructureTestCase;
use Ramsey\Uuid\Uuid;

class ApiGetPFCContentIntegrationTest extends DoctrineBaseInfraestructureTestCase
{
    private ?PfcRepository $pfcRepository = null;

    public function test_if_content_dont_exists_throw_exception(): void
    {
        $this->expectException(\Exception::class);
        $this->application()->execute(Uuid::uuid4());
    }

    public function test_if_pfc_exits_then_it_is_return(): void
    {
        $uuid = Uuid::uuid4();
        $tittle = "Titulo PFC";
        $this->shouldExistPfc($uuid, $tittle);
        $target = $this->application()->execute($uuid);
        $this->assertNotNull($target);
        $this->assertEquals($tittle, $target["title"]);
        $this->assertNull($target["sections"]);
    }

    private function shouldExistPfc(string $uuid, string $title): void
    {
        $this->repository()->add(DocumentMother::create($uuid, $title));
        $this->flush();
    }

    private function application(): ApiGetPFCContent
    {
        return new ApiGetPFCContent($this->repository());
    }

    private function repository(): PfcRepository
    {
        if (null === $this->pfcRepository) {
            $this->pfcRepository = new PfcRepository($this->em());
        }
        return $this->pfcRepository;
    }
}