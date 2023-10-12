<?php

namespace App\Pfc\infrastructure;

use App\Entity\Document;
use App\Repository\DocumentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


final class PfcRepository
{
    private DocumentRepository $repository;

    public function __construct(EntityManagerInterface $registry)
    {
        $this->repository = $registry->getRepository(Document::class);
    }

    public function findByUuid(string $value): ?Document
    {
        return $this->repository->findByUuid($value);;
    }

    public function findByVersion(string $param): ?Document
    {
        return $this->repository->findByVersion($param);;
    }


    public function add(Document $entity, bool $flush = false): void
    {
        $this->repository->add($entity, $flush);

    }
}