<?php 

declare(strict_types=1);

namespace App\Pfc\infrastructure\;

use App\Entity\Document;
use Doctrine\Persistence\ManagerRegistry;


class PfcRepository
{
    private DocumentRepository $repository;

    public function __construct(ManagerRegistry $registry)
    {
        $this->repository = $registry->getRepository(Document::class);
    }

    public function findByUuid(string $value): ?Document
    {
        return $this->repository->findByUuid($value);
        ;
    }


    public function add(Document $entity, bool $flush = false): void
    {
        $this->repository->add($entity, $flush);

    }
}