<?php 

namespace App\Tests\Pfc\NewPfc;

use App\Pfc\application\NewPfc\NewPfcApplication;
use PHPUnit\Framework\TestCase;
use App\Pfc\infrastructure\PfcRepository;

final class NewPfcAppliacationTest extends TestCase
{
    /** @test */
   public function if_pfc_exists_throw_exception(): void 
   {
        $this->expectException(\Exception::class);
        $pfc = $this->application();
        $pfc->execute(["id" => "test", "title" => "TestTitle"]);
   }

   private function application(): NewPfcApplication
   {
     return new NewPfcApplication($this->repository());
   }

   private function repository(): PfcRepository
   {
     return $this->createMock(PfcRepository::class);
   }

   private function shouldExistPfc(): void
   {
     $this->repository->expects($this->once())
                 ->method('findByUuid')
                 ->willReturn("testing") ;
   }
}
