<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class subCapController extends AbstractController
{
    #[Route(path: '/subCap', name: 'subCap', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('subCap.html.twig', []);
    }
}