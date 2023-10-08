<?php

namespace App\Pfc\application\GetPFC;

use App\Entity\Document;

final class ApiGetPFCContent
{
    public function __construct(private $repository)
    {

    }

    public function execute (string $id): array
    {
        $dataDB = $this->repository->findByVersion($id);
        if(!$dataDB) {
            throw new \Exception("Document not found");
        }
        return  [
            'title' => $dataDB->getTitle(),
            'sections' => json_decode($dataDB->getContent(), true),
        ];
    }
}