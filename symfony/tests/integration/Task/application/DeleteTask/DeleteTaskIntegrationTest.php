<?php

namespace App\Tests\integration\Task\application\DeleteTask;

use App\Task\application\DeleteTask\ApiDeleteTaskApplication;
use App\Task\infrastructure\TaskRepositoryBridge;
use App\Tests\Shared\domain\model\TaskMother;
use App\Tests\Shared\infrastrucutre\Doctrine\DoctrineBaseInfraestructureTestCase;
use Ramsey\Uuid\Nonstandard\Uuid;

class DeleteTaskIntegrationTest extends DoctrineBaseInfraestructureTestCase
{
    private ?TaskRepositoryBridge $taskRepository = null;

    public function test_if_task_dont_exists_throw_exception(): void
    {
        $uuid = Uuid::uuid4();
        $this->expectException(\Exception::class);
        $this->application()->execute($uuid);
    }

    public function test_if_task_exits_then_it_is_deleted(): void
    {
        $uuid = Uuid::uuid4();
        $this->shouldExistTask($uuid);
        $this->application()->execute($uuid);
        $deleteTask = $this->taskRepository->findByUuid($uuid);
        $this->assertEquals($uuid, $deleteTask->getUuid());
        $this->assertEquals(1, $deleteTask->getIsDeleted());
    }

    private function application(): ApiDeleteTaskApplication
    {
        return new ApiDeleteTaskApplication($this->repository());
    }

    private function repository(): TaskRepositoryBridge
    {
        if (null === $this->taskRepository) {
            $this->taskRepository = new TaskRepositoryBridge($this->em());
        }
        return $this->taskRepository;
    }

    private function shouldExistTask(string $uuid): void
    {
        $this->repository()->add(TaskMother::create($uuid));
        $this->flush();
    }
}