<?php

namespace App\Pfc\application\NewPfc;

use App\Entity\Document;
use Doctrine\Persistence\ManagerRegistry;

final class NewPfcApplication
{
    public function __construct(private PfcRepository $repository)
    {

    }

    public function execute(array $param): void
    {
        // Busco la tarea por uuid
        $document = $this->repository->findByUuid($param['id']);

        // Si esta, error
        if ($document) {
            throw new \Exception('Document found for id '.$param['id']);
        }

        // Preparo entidad para mandar a repository
        $document = new Document();
        $document->setUuid($param['id']);
        $document->setTitle($param['title']);
        $document->setVersion(1);
        $document->setCreatedAt(new \DateTime());
        $document->setContent('');

        // Mando accion (add) al repository
        $this->repository->add($document, true);
    }
}
