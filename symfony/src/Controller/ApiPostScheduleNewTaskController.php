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

class ApiPostScheduleNewTaskController extends AbstractController
{
    #[Route('/api/schedule/newTask', name: 'schedule_new_task', methods: ['POST'])]
    public function newTask(ManagerRegistry $doctrine, Request $request): Response
    {
        try {
            
            // Recupero datos desde request
            $param = json_decode($request->getContent(), true);

            // Busco la tarea por uuid
            $task = $doctrine->getManager()->getRepository(Task::class)->findByUuid($param['id']);

            // Si no esta error
            if ($task) {
                throw new \Exception('Task found for id '.$param['id']);
            }

            // Preparo entidad para mandar a repository
            $task = new Task();
            $task->setUuid($param['id']);
            $task->setName($param['name']);
            $task->setDescription($param['description']);
            $task->setPriority($param['priority']);
            $task->setTimeTotal(0);
            $task->setIdProject(1);
            $task->setDone(0);
            $task->setCreatedAt(new \DateTime());
            $task->setColor('danger');
            $task->setIsDeleted(0);

            // Mando accion (add) al repository
            $doctrine->getRepository(Task::class)->add($task, true);
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
