<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class editTaskController extends AbstractController
{
    #[Route(path: '/editTask', name: 'editTask', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('editTask.html.twig', []);
    }
}