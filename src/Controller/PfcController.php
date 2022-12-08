<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PfcController extends AbstractController
{
    #[Route(path: '/pfc', name: 'pfc', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('pfc.html.twig', []);
    }
}