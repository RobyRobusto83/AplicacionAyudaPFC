<?php

namespace App\Controller;

use App\Pfc\application\NewPfc\NewPfcApplication;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class ApiPostPFCNewController extends AbstractController
{
    #[Route('/api/pfc/new', name: 'pfc_new_document', methods: ['POST'])]
    public function new(ManagerRegistry $doctrine, Request $request): Response
    {
        try {
            
            // Recupero datos desde request
            $param = json_decode($request->getContent(), true);

            $useCase = new NewPfcApplication($doctrine);
            $useCase->execute($param);

            // Informo Ok al cliente
            return new Response(
                "OK",
                Response::HTTP_OK,
                ['Content-type' => 'application/' . $request->getContentType()]
            );

        } catch (Throwable $e) {
            return new JsonResponse(
                [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
