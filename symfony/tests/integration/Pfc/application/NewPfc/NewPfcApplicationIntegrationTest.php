<?php

namespace App\Tests\integration\Pfc\application\NewPfc;

use App\Pfc\application\NewPfc\NewPfcApplication;
use App\Pfc\infrastructure\PfcRepository;
use App\Tests\Shared\domain\model\DocumentMother;
use App\Tests\Shared\infrastrucutre\Doctrine\DoctrineBaseInfraestructureTestCase;

class NewPfcApplicationIntegrationTest extends DoctrineBaseInfraestructureTestCase
{
 private ?PfcRepository $pfcRepository = null;

   public function test_if_pfc_exists_throw_exception(): void
   {
        $this->expectException(\Exception::class);
        $this->shouldExistPfc("test", "TestTitle");
        $this->application()->execute(["id" => "test", "title" => "TestTitle"]);
   }

    public function test_if_pfc_dont_exits_then_it_is_created(): void
    {
        $uuid = "newUuid";
        $title = "PFC title";
        $this->application()->execute(["id" => $uuid, "title" => $title]);
        $createdPfc = $this->pfcRepository->findByUuid("newUuid");
        $this->assertEquals($uuid, $createdPfc->getUuid());
        $this->assertEquals($title, $createdPfc->getTitle());
        $this->assertEquals(1, $createdPfc->getVersion());
    }

    private function shouldExistPfc(string $uuid, string $title): void
    {
        $this->repository()->add(DocumentMother::create($uuid, $title));
        $this->flush();
    }

    private function application(): NewPfcApplication
    {
        return new NewPfcApplication($this->repository());
    }

    private function repository(): PfcRepository
    {
        if (null === $this->pfcRepository) {
            $this->pfcRepository = new PfcRepository($this->em());
        }
        return $this->pfcRepository;
    }
}