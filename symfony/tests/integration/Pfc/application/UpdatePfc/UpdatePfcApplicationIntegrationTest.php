<?php

namespace App\Tests\integration\Pfc\application\UpdatePfc;

use App\Pfc\application\UpdatePfc\UpdatePfcApplication;
use App\Pfc\infrastructure\PfcRepository;
use App\Tests\Shared\domain\model\DocumentMother;
use App\Tests\Shared\infrastrucutre\Doctrine\DoctrineBaseInfraestructureTestCase;
use Ramsey\Uuid\Nonstandard\Uuid;

class UpdatePfcApplicationIntegrationTest extends DoctrineBaseInfraestructureTestCase
{
    private ?PfcRepository $pfcRepository = null;

    public function test_if_pfc_dont_exists_throw_exception(): void
    {
        $this->expectException(\Exception::class);
        $this->application()->execute(
            [
                "id" => "test",
                "title" => "TestTitle",
                "sections" => ""
            ]
        );
    }

    public function test_if_pfc_exits_then_it_is_updated(): void
    {
        $uuid = Uuid::uuid4();
        $tittle = "PFC title";
        $sections = "";
        $this->shouldExistPfc($uuid, $tittle);
        $this->application()->execute(["id" => $uuid, "tittle" => $tittle, "sections" =>$sections ]);
        $updatePfc = $this->pfcRepository->findByUuid($uuid);
        $this->assertEquals($uuid, $updatePfc->getUuid());
        $this->assertEquals($tittle, $updatePfc->getTitle());
        $this->assertEquals(2, $updatePfc->getVersion());
    }

    private function application(): UpdatePfcApplication
    {
        return new UpdatePfcApplication($this->repository());
    }

    private function repository(): PfcRepository
    {
        if (null === $this->pfcRepository) {
            $this->pfcRepository = new PfcRepository($this->em());
        }
        return $this->pfcRepository;
    }

    private function shouldExistPfc(string $uuid, string $title): void
    {
        $this->repository()->add(DocumentMother::create($uuid, $title));
        $this->flush();
    }
}