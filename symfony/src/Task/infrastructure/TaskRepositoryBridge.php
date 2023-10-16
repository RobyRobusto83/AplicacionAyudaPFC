<?php

namespace App\Task\infrastructure;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;

class TaskRepositoryBridge
{
    private TaskRepository $repository;

    public function __construct(EntityManagerInterface $registry)
    {
        $this->repository = $registry->getRepository(Task::class);
    }

    public function findByUuid(string $value): ?Task
    {
        return $this->repository->findByUuid($value);
    }

    public function findByVersion(string $param): ?Task
    {
        return $this->repository->findByVersion($param);
    }

    public function add(Task $entity): void
    {
        $this->repository->save($entity);
    }

    public function save(Task $entity): void
    {
        $this->repository->save($entity);
    }
}