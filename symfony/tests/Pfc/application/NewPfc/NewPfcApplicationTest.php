<?php 

namespace App\Tests\Pfc\application\NewPfc;

use App\Pfc\application\NewPfc\NewPfcApplication;
use PHPUnit\Framework\TestCase;
use App\Pfc\infrastructure\PfcRepository;
use App\Entity\Document;

final class NewPfcApplicationTest extends TestCase
{
  private $repository;

    /** @test */
   public function if_pfc_exists_throw_exception(): void 
   {
        $this->expectException(\Exception::class);
        $this->shouldExistPfc();
        $this->application()->execute(["id" => "test", "title" => "TestTitle"]);
   }

    /** @test */
   public function if_pfc_dont_exits_then_it_is_created(): void
   {
        $this->shouldNotExistPfc();
        $this->shouldSaveDocument();
        $this->application()->execute(["id" => "test", "title" => "TestTitle"]);
   }

   private function application(): NewPfcApplication
   {
     return new NewPfcApplication($this->repository());
   }

   private function repository(): PfcRepository
   {
    if (null === $this->repository){
      $this->repository = $this->createMock(PfcRepository::class);
    }
     return $this->repository;
   }

   private function shouldExistPfc(): void
   {
     $this->repository()->expects($this->once())
                 ->method('findByUuid')
                 ->willReturn(DocumentMother::create());
   }

   private function shouldNotExistPfc(): void
   {
     $this->repository()->expects($this->once())
                 ->method('findByUuid')
                 ->willReturn(null);
   }

   private function shouldSaveDocument(): void
   {
    $this->repository()->expects($this->once())->method('add');
   }


}