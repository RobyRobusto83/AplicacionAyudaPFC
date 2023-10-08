<?php

namespace App\Tests\Shared\domain\model;

use App\Entity\Task;

final class TaskMother
{
    public static function create(): Task
    {
        $task = new Task();
        $task->setUuid("Task1");
        $task->setName("Task T");
        $task->setDescription('description');
        $task->setPriority(1);
        $task->setCreatedAt(new \DateTime());
        $task->setTimeTotal(0);
        $task->setIdProject(1);
        $task->setCreatedAt(new \DateTime());
        $task->setColor('danger');
        $task->setDone(0);
        $task->setIsDeleted(0);

        return $task;
    }
}