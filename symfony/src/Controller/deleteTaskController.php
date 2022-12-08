<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class deleteTaskController extends AbstractController
{
    #[Route(path: '/deleteTask', name: 'deleteTask', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('deleteTask.html.twig', []);
    }
}