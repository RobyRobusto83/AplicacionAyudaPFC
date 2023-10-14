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
        $lastVersion->setTitle($param['tittle']);
        $lastVersion->setVersion($lastVersion->getVersion() + 1);
        $lastVersion->setContent(json_encode($param['sections']));

            // Mando accion (add) al repository
            $this->repository->add($lastVersion, true);
    }
}