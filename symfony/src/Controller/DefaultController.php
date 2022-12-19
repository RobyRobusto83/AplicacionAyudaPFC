<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route(path: '/', name: 'main', methods: ['GET'])]
    public function home(): Response
    {
        $wellcome = '...';

        return $this->render('index.html.twig', [
            'wellcome' => $wellcome,
        ]);
    }
}