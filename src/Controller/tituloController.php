<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class tituloController extends AbstractController
{
    #[Route(path: '/titulo', name: 'titulo', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('titulo.html.twig', []);
    }
}