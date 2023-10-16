<?php

namespace App\Tests\integration\Task\application\NewTask;

use App\Task\application\NewTask\NewTaskApplication;
use App\Task\infrastructure\TaskRepositoryBridge;
use App\Tests\Shared\domain\model\TaskMother;
use App\Tests\Shared\infrastrucutre\Doctrine\DoctrineBaseInfraestructureTestCase;
use Ramsey\Uuid\Nonstandard\Uuid;

class NewTaskApplicationIntegrationTest extends DoctrineBaseInfraestructureTestCase
{
    private ?TaskRepositoryBridge $taskRepository = null;

    public function test_if_task_exists_throw_exception(): void
    {
        $uuid = Uuid::uuid4();
        $this->expectException(\Exception::class);
        $this->shouldExistTask($uuid);
        $this->application()->execute(["id" => $uuid]);
    }

    public function test_if_task_dont_exits_then_it_is_created(): void
    {
        $uuid = Uuid::uuid4();
        $this->application()->execute(
            [
                "id" => $uuid,
                "name" => "Task T",
                "description" => "Description",
                "priority" => "1"
            ]
        );
        $this->flush();
        $createdPfc = $this->taskRepository->findByUuid($uuid);
        $this->assertEquals($uuid, $createdPfc->getUuid());
        $this->assertEquals("Task T", $createdPfc->getName());
        $this->assertEquals("Description", $createdPfc->getDescription());
    }

    private function application(): NewTaskApplication
    {
        return new NewTaskApplication($this->repository());
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