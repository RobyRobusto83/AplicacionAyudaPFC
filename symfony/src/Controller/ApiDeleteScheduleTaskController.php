<?php

declare(strict_types=1);

namespace App\Controller;

use App\Task\application\NewTask\ApiDeleteTaskApplication;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class ApiDeleteScheduleTaskController extends AbstractController
{
    #[Route('/api/schedule/deleteTask/{uuid}', name: 'schedule_delete_task', methods: ['DELETE'])]
    public function deleteTask(ManagerRegistry $doctrine, Request $request): Response
    {
        try {
            // Recupero datos desde request
            $id = $request->attributes->get("uuid");

            $useCase = new ApiDeleteTaskApplication($doctrine);
            $useCase->execute($id);

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
    // public function update(ManagerRegistry $doctrine, int $uuid): Response
    // {
    //     $entityManager = $doctrine->getManager();
    //     $product = $entityManager->getRepository(Product::class)->find($uuid);

        
}
