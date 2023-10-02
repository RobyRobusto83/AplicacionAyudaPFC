<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Document;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class ApiPostPFCUpdateDocumentController extends AbstractController
{
    #[Route('/api/pfc/update', name: 'pfc_update_document', methods: ['POST'])]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        try {
            
            // Recupero datos desde request
            $param = json_decode($request->getContent(), true);

            // Busco la tarea por uuid
            $lastVersion = $doctrine->getManager()->getRepository(Document::class)->findByVersion($param['id']);

            // Si no esta, error
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
            $doctrine->getRepository(Document::class)->add($document, true);
        } catch (Throwable $e) {
            return new JsonResponse(
                [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        // Informo Ok al cliente
        return new Response(
            "OK",
            Response::HTTP_OK,
            ['Content-type' => 'application/' . $request->getContentType()]
        );
    }
}
