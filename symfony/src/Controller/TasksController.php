<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TasksController extends AbstractController
{
    #[Route(path: '/tasks', name: 'tasks', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('tasks.html.twig', []);
    }
}