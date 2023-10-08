<?php

namespace App\Controller;

use App\Entity\Task;
use App\Pfc\application\NewPfc\NewTaskApplication;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class ApiPostScheduleNewTaskController extends AbstractController
{
    #[Route('/api/schedule/newTask', name: 'schedule_new_task', methods: ['POST'])]
    public function newTask(ManagerRegistry $doctrine, Request $request): Response
    {
        try {
            // Recupero datos desde request
            $param = json_decode($request->getContent(), true);

            $useCase = new NewTaskApplication($doctrine);
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
