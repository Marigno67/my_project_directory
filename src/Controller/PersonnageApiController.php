<?php

namespace App\Controller;

use App\Entity\Personnage;
use App\Repository\PersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PersonnageApiController extends AbstractController
{
    #[Route('/api/personnages', name: 'app_personnage_list', methods: ['GET'])]
    public function list(PersonnageRepository $personnageRepository): JsonResponse
    {
        // Utilise une requête avec JOIN explicite pour charger les éléments
        $personnages = $personnageRepository->findAllWithElement();

        // Transformation manuelle en array pour contourner le problème de sérialisation
        $data = [];
        foreach ($personnages as $personnage) {
            $element = $personnage->getElement();
            $data[] = [
                'id' => $personnage->getId(),
                'nom' => $personnage->getNom(),
                'description' => $personnage->getDescription(),
                'image' => $personnage->getImage(),
                'element' => $element ? [
                    'id' => $element->getId(),
                    'nom' => $element->getNom(),
                    'icone' => $element->getIcone()
                ] : null
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/api/personnages/{id}', name: 'app_personnage_show', methods: ['GET'])]
    public function show(Personnage $personnage, SerializerInterface $serializer): JsonResponse
    {
        $jsonContent = $serializer->serialize($personnage, 'json', ['groups' => ['personnage:read', 'personnage:read:details']]);

        return new JsonResponse($jsonContent, 200, [], true);
    }
}