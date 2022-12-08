<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class capituloController extends AbstractController
{
    #[Route(path: '/capitulo', name: 'capitulo', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('capitulo.html.twig', []);
    }
}