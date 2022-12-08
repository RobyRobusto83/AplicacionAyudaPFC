<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class temporizadorController extends AbstractController
{
    #[Route(path: '/temporizador', name: 'temporizador', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('temporizador.html.twig', []);
    }
}