<?php

namespace App\Task\infrastructure;

use App\Entity\Task;
use Doctrine\Persistence\ManagerRegistry;

final class TaskRepository
{
    private TaskRepository $repository;

    public function __construct(ManagerRegistry $registry)
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

    public function add(Task $entity, bool $flush = false): void
    {
        $this->repository->add($entity, $flush);
    }
}