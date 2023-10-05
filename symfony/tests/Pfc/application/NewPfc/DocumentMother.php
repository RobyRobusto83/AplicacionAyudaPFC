<?php 

namespace App\Tests\Pfc\application\NewPfc;

use App\Entity\Document;

final class DocumentMother 
{
    public static function create(): Document
    {
        $document = new Document();
        $document->setUuid("PFC1");
        $document->setTitle("Titulo PFC");
        $document->setVersion(1);
        $document->setCreatedAt(new \DateTime());
        $document->setContent('');

        return $document;
    }
}