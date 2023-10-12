<?php

namespace App\Task\application\DeleteTask;

final class ApiDeleteTaskApplication
{
    public function __construct(private $repository)
    {

    }

    public function execute(string $id): void
    {
         // Busco la tarea por uuid
            $task = $this->repository->findByUuid($id);

            // Si esta lo borro
            if ($task) {
                // $doctrine->getManager()->getRepository(Task::class)->remove($task);
                $task->setIsDeleted(1);
                $this->repository->save($task);
            }
    }
}