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

class ApiPostScheduleAssignTimeToTaskController extends AbstractController
{
    #[Route('/api/schedule/assignTimeToTask', name: 'schedule_assign_time_to_task', methods: ['POST'])]
    public function assignTimeToTask(ManagerRegistry $doctrine, Request $request): Response
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
            if (!$task->getDone()){
                $task->assignTime($param['time']);
            }
            
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
    // public function update(ManagerRegistry $doctrine, int $uuid): Response
    // {
    //     $entityManager = $doctrine->getManager();
    //     $product = $entityManager->getRepository(Product::class)->find($uuid);

        
}
