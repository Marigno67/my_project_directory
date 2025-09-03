<?php

namespace App\Controller;

use App\Entity\ModeDeJeu;
use App\Repository\ModeDeJeuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ModeDeJeuController extends AbstractController
{
    #[Route('/api/modes-de-jeu', name: 'app_modes_de_jeu_list', methods: ['GET'])]
    public function list(ModeDeJeuRepository $modeDeJeuRepository, SerializerInterface $serializer): JsonResponse
    {
        $modes = $modeDeJeuRepository->findAll();
        $jsonContent = $serializer->serialize($modes, 'json', ['groups' => 'modeDeJeu:read']);

        return new JsonResponse($jsonContent, 200, [], true);
    }

    #[Route('/api/modes-de-jeu/{id}', name: 'app_modes_de_jeu_show', methods: ['GET'])]
    public function show(ModeDeJeu $modeDeJeu, SerializerInterface $serializer): JsonResponse
    {
        $jsonContent = $serializer->serialize($modeDeJeu, 'json', ['groups' => 'modeDeJeu:read']);

        return new JsonResponse($jsonContent, 200, [], true);
    }
}