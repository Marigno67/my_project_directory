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
    public function list(PersonnageRepository $personnageRepository, SerializerInterface $serializer): JsonResponse
    {
        $personnages = $personnageRepository->findAll();
        $jsonContent = $serializer->serialize($personnages, 'json', ['groups' => 'personnage:read']);

        return new JsonResponse($jsonContent, 200, [], true);
    }

    #[Route('/api/personnages/{id}', name: 'app_personnage_show', methods: ['GET'])]
    public function show(Personnage $personnage, SerializerInterface $serializer): JsonResponse
    {
        $jsonContent = $serializer->serialize($personnage, 'json', ['groups' => ['personnage:read', 'personnage:read:details']]);

        return new JsonResponse($jsonContent, 200, [], true);
    }
}