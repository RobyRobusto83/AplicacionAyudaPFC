<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class addTaskController extends AbstractController
{
    #[Route(path: '/addTask', name: 'addTask', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('addTask.html.twig', []);
    }
}