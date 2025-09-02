<?php

namespace App\Controller;

use App\Repository\PersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PersonnageController extends AbstractController
{
    /**
     * @param PersonnageRepository $personnageRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    #[Route('/api/personnages', name: 'app_personnage_list')]
    public function list(PersonnageRepository $personnageRepository, SerializerInterface $serializer): JsonResponse
    {
        // Récupère tous les personnages de la base de données
        $personnages = $personnageRepository->findAll();

        // Convertit la liste des personnages en JSON
        $jsonContent = $serializer->serialize($personnages, 'json', ['groups' => 'personnage:read']);

        // Retourne la réponse JSON
        return new JsonResponse($jsonContent, 200, [], true);
    }
}