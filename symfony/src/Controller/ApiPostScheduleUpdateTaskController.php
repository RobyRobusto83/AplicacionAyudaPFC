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

class ApiPostScheduleUpdateTaskController extends AbstractController
{
    #[Route('/api/schedule/updateTask', name: 'schedule_update_task', methods: ['POST'])]
    public function updateTask(ManagerRegistry $doctrine, Request $request): Response
    {
        try {
            // Recupero datos desde request
            $param = json_decode($request->getContent(), true);

            // Busco la tarea por uuid
            $task = $doctrine->getManager()->getRepository(Task::class)->findByUuid($param['id']);

            // Si no esta error
            if (!$task) {
                throw new \Exception('No task found for id '.$param['id']);
            }

            // Modifico la tarea
            $task->setName($param['name']);
            $task->setDescription($param['description']);
            $task->setPriority($param['priority']);
            $task->setTimeTotal($param['total_time']);
            $task->setDone((int)$param['done']);
            $task->setColor($param['color']);
            
            $doctrine->getManager()->flush();            
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
