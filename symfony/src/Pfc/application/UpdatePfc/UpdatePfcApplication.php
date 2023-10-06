<?php

namespace App\Pfc\application\UpdatePfc;

use App\Entity\Document;
use Doctrine\Persistence\ManagerRegistry;

final class UpdatePfcApplication
{
    public function __construct(private $repository)
    {

    }

    public function execute(array $param): void
    {
        // Busco la tarea por uuid
        $lastVersion = $this->repository->findByVersion($param['id']);

        if (!$lastVersion) {
                throw new \Exception('Document not found for id '.$param['id']);
            }

        // Preparo entidad para mandar a repository
            $document = new Document();
            $document->setUuid($lastVersion->getUuid());
            $document->setTitle($param['title']);
            $document->setVersion($lastVersion->getVersion() + 1);
            $document->setCreatedAt(new \DateTime());
            $document->setContent(json_encode($param['sections']));

            // Mando accion (add) al repository
            $this->repository->add($document, true);
    }
}