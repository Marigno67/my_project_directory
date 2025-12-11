<?php

namespace App\Controller;

use App\Repository\EnsembleNoyauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class NoyauApiController extends AbstractController
{
    #[Route('/api/noyaux', name: 'app_noyau_list', methods: ['GET'])]
    public function list(EnsembleNoyauRepository $ensembleNoyauRepository, SerializerInterface $serializer): JsonResponse
    {
        // Récupérer tous les ensembles avec leurs noyaux
        $ensembles = $ensembleNoyauRepository->findAll();

        $jsonContent = $serializer->serialize($ensembles, 'json', ['groups' => 'ensembleNoyau:read']);

        return new JsonResponse($jsonContent, 200, [], true);
    }
}
