<?php

namespace App\Task\application\NewTask;

use App\Entity\Task;

final class NewTaskApplication
{
    public function __construct(private $repository)
    {

    }

    public function execute(array $param): void
    {
        // Busco la tarea por uuid
        $task = $this->repository->findByUuid($param['id']);

        // Si no esta error
        if ($task) {
            throw new \Exception('Task found for id ' . $param['id']);
        }

        // Preparo entidad para mandar a repository
        $task = new Task();
        $task->setUuid($param['id']);
        $task->setName($param['name']);
        $task->setDescription($param['description']);
        $task->setPriority($param['priority']);
        $task->setTimeTotal(0);
        $task->setIdProject(1);
        $task->setDone(0);
        $task->setCreatedAt(new \DateTime());
        $task->setColor('danger');
        $task->setIsDeleted(0);

        // Mando accion (add) al repository
        $this->repository->add($task, true);
    }
}