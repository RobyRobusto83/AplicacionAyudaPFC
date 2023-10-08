<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Document;
use App\Pfc\application\GetPFC\ApiGetPFCContent;
use Doctrine\Persistence\ManagerRegistry;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class ApiGetPFCContentController extends AbstractController
{

    #[Route('/api/pfc/getContent/{uuid}', name: 'pfc_get_content', methods: ['GET'])]
    public function getContent(ManagerRegistry $doctrine, Request $request, $data): Response
    {
        try {
            $id = $request->attributes->get("uuid");

            $useCase = new ApiGetPFCContent($doctrine);
            $data = $useCase->execute($id);

            return new Response(
                json_encode($this->prepareResponseData($data), JSON_THROW_ON_ERROR),
                Response::HTTP_OK,
                ['Content-type' => 'application/' . $request->getContentType()]
            );
        } catch (Throwable $e) {
            return new JsonResponse(
                [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
    
    private function prepareResponseData(array $data): array
    {
        return ['document' => $data];
    }
}
