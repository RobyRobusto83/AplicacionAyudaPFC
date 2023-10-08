<?php

namespace App\Tests\Task\application\NewTask;

use App\Repository\TaskRepository;
use App\Task\application\NewTask\NewTaskApplication;
use App\Tests\Shared\domain\model\DocumentMother;
use App\Tests\Shared\domain\model\TaskMother;
use PHPUnit\Framework\TestCase;

class NewTaskApplicationTest extends TestCase
{
    private $repository;

    /** @test */
    public function if_task_exists_throw_exception(): void
    {
        $this->expectException(\Exception::class);
        $this->shouldExistTask();
        $this->application()->execute(["id" => "Task1"]);
    }

    /** @test */
    public function if_task_dont_exits_then_it_is_created(): void
    {
        $this->shouldNotExistTask();
        $this->shouldSaveTask();
        $this->application()->execute(["id" => "Task1", "name" => "Task T", "description" => "Description","priority" => "1"]);
    }

     private function application(): NewTaskApplication
   {
     return new NewTaskApplication($this->repository());
   }

   private function repository(): TaskRepository
   {
    if (null === $this->repository){
      $this->repository = $this->createMock(TaskRepository::class);
    }
     return $this->repository;
   }

   private function shouldExistTask(): void
   {
     $this->repository()->expects($this->once())
                 ->method('findByUuid')
                 ->willReturn(TaskMother::create());
   }

   private function shouldNotExistTask(): void
   {
     $this->repository()->expects($this->once())
                 ->method('findByUuid')
                 ->willReturn(null);
   }

   private function shouldSaveTask(): void
   {
    $this->repository()->expects($this->once())->method('add');
   }
}
