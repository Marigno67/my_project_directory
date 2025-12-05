<?php

namespace App\Controller;

use App\Repository\ArmeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ArmeApiController extends AbstractController
{
    #[Route('/api/armes', name: 'app_arme_list', methods: ['GET'])]
    public function list(ArmeRepository $armeRepository): JsonResponse
    {
        $armes = $armeRepository->findAll();

        $data = [];
        foreach ($armes as $arme) {
            $element = $arme->getElement();
            $data[] = [
                'id' => $arme->getId(),
                'nom' => $arme->getNom(),
                'description' => $arme->getDescription(),
                'image' => $arme->getImage(),
                'element' => $element ? [
                    'id' => $element->getId(),
                    'nom' => $element->getNom(),
                    'icone' => $element->getIcone()
                ] : null
            ];
        }

        return new JsonResponse($data);
    }
}
