<?php

namespace App\Tests\Task\application\DeleteTask;

use App\Task\application\DeleteTask\ApiDeleteTaskApplication;
use App\Task\infrastructure\TaskRepository;
use App\Tests\Shared\domain\model\TaskMother;
use PHPUnit\Framework\TestCase;

class ApiDeleteTaskApplicationTest extends TestCase
{
    private $repository;

    /** @test */
    public function if_task_dont_exits_then_it_is_deleted(): void
    {
        $this->shouldExistTask();
        $this->application()->execute("id");
    }

    /** @test */
    public function if_task_exists_throw_exception(): void
    {
        $this->shouldNotExistTask();
        $this->expectException(\Exception::class);
        $this->application()->execute("id");
        $this->shouldExistTask();
        $this->application()->execute("id");
    }

    private function application(): ApiDeleteTaskApplication
    {
        return new ApiDeleteTaskApplication($this->repository());
    }

    private function repository(): TaskRepository
    {
        if (null === $this->repository) {
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
}
