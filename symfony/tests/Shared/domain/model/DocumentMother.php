<?php 

namespace App\Tests\Shared\domain\model;

use App\Entity\Document;

final class DocumentMother 
{
    public static function create(?string $uuid, ?string $title): Document
    {
        if(null === $uuid){
            $uuid = "PFC1";
        }

        if(null === $title){
            $title = "Titulo PFC";
        }

        $document = new Document();
        $document->setUuid($uuid);
        $document->setTitle($title);
        $document->setVersion(1);
        $document->setCreatedAt(new \DateTime());
        $document->setContent('');

        return $document;
    }
}