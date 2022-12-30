<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Task;
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

            // Busco la tarea por uuid
            $task = $doctrine->getManager()->getRepository(Task::class)->findByUuid($id);
            // Si esta lo borro
            if ($task) {
                // $doctrine->getManager()->getRepository(Task::class)->remove($task);
                $task->setIsDeleted(1);
                $doctrine->getManager()->flush(); 
            }     
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
    // public function update(ManagerRegistry $doctrine, int $uuid): Response
    // {
    //     $entityManager = $doctrine->getManager();
    //     $product = $entityManager->getRepository(Product::class)->find($uuid);

        
}
