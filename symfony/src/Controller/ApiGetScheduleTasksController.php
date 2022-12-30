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

class ApiGetScheduleTasksController extends AbstractController
{
    #[Route('/api/schedule/tasks', name: 'schedule_get_tasks', methods: ['GET'])]
    public function getTasks(ManagerRegistry $doctrine, Request $request): Response
    {
        try {
            // $data = $this->getData();
            $data = $this->getFromDatabase($doctrine);
        } catch (Throwable $e) {
            return new JsonResponse(
                [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        return new Response(
            json_encode($this->prepareResponseData($data), JSON_THROW_ON_ERROR),
            Response::HTTP_OK,
            ['Content-type' => 'application/' . $request->getContentType()]
        );

    }
    
    private function getFromDatabase(ManagerRegistry $mr): array
    {
        $tasks = [];        
        $data = $mr->getRepository(Task::class)->findByIdProject(1);

        foreach($data as $task) {
            $tasks[] = [          
                'uuid' => $task->getUuid(),
                'isCompleted' => (bool)$task->getDone(),
                'name' => $task->getName(), 
                'description' => $task->getDescription(), 
                'priority' => $task->getPriority(), 
                '_rowVariant' => $task->getColor()
            ];
        }

        return $tasks;
        return [
            
        ];
    }

    private function prepareResponseData(array $data): array
    {
        return ['tasks' => $data];
    }

    private function getData(): array
    {
        return [
            [ 'uuid' => 'fbaa61ea-d09e-4ce3-becc-53ae4e310a90', 'isCompleted' => true, 'name' => 'Dickerson Macdonald', 'description' => "Lorem ipsum (backend)", 'priority' => "Alta", '_rowVariant' => 'danger' ],
            [ 'uuid' => 'aa458983-2942-4f27-8f15-08ec6e168e25', 'isCompleted' => false, 'name' => 'Larsen Shaw', 'description' => "Mauris auctor mattis ", 'priority' => "Media", '_rowVariant' => 'warning'  ],
            [ 'uuid' => '605e1cbc-2046-48f9-96ed-f337c2a1147b', 'isCompleted' => false, 'name' => 'Mini Navarro', 'description' => "Proin fermentum mi sed", 'priority' => "Baja", '_rowVariant' => 'success' ],
            [ 'uuid' => 'd9433860-fc94-42b2-9f01-545743732bd4', 'isCompleted' => false, 'name' => 'Geneva Wilson', 'description' => "Nam in tempor massa.", 'priority' => "Alta", '_rowVariant' => 'danger'  ],
            [ 'uuid' => '73ad4caa-fba0-4b8b-a9a8-44d2796a025c', 'isCompleted' => true,  'name' => 'Jami Carney', 'description' => "In aliquet lacinia ornare", 'priority' => "Baja" , '_rowVariant' => 'success'  ],
            [ 'uuid' => '79b8f640-5fd3-41ae-b30b-7075a3f46f3a', 'isCompleted' => false, 'name' => 'Essie Dunlap', 'description' => "Cras interdum malesuada odio", 'priority' => "Alta" , '_rowVariant' => 'danger' ],
            [ 'uuid' => 'cbdc1f91-5750-4e37-bf15-8980c352ecf8', 'isCompleted' => true, 'name' => 'Thor Macdonald', 'description' => "Vivamus pharetra arcu id neque", 'priority' => "Alta" , '_rowVariant' => 'danger' ],
            [ 'uuid' => 'd92ac566-133b-48f6-8d00-de84971ab244', 'isCompleted' => true, 'name' => 'Larsen Shaw', 'description' => "Curabitur eget fermentum ex", 'priority' => "Baja", '_rowVariant' => 'success'  ],
            [ 'uuid' => '135dfdd6-a61f-4115-a0b0-4254136aa30b', 'isCompleted' => false, 'name' => 'Mitzi Navarro', 'description' => "Etiam ac lacus lorem.", 'priority' => "Alta" , '_rowVariant' => 'danger' ],
            [ 'uuid' => 'a9861306-893c-4735-8d0e-908f5d848981', 'isCompleted' => false, 'name' => 'Genevieve Wilson' , 'description' => "Vestibulum ante ipsum primis", 'priority' => "Media", '_rowVariant' => 'warning' ],
            [ 'uuid' => '58ee404e-923f-45a2-8d6b-cc7606f4fce5', 'isCompleted' => true,  'name' => 'John Carney' , 'description' => "Fusce viverra non leo vel tincidunt", 'priority' => "Baja", '_rowVariant' => 'success'  ],
            [ 'uuid' => 'bad35a4b-5727-4fed-9e46-cc5840fb6d4d', 'isCompleted' => false, 'name' => 'Dick Dunlap' , 'description' => "Curabitur lorem eros", 'priority' => "Alta", '_rowVariant' => 'danger' ]
        ];
    }
}
