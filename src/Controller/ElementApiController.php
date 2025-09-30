<?php

namespace App\Controller;

use App\Repository\ElementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ElementApiController extends AbstractController
{
    #[Route('/api/elements', name: 'app_element_list', methods: ['GET'])]
    public function list(ElementRepository $elementRepository, SerializerInterface $serializer): JsonResponse
    {
        $elements = $elementRepository->findAll();
        // On utilise un nouveau groupe 'element:read' pour ne pas charger les personnages avec
        $jsonContent = $serializer->serialize($elements, 'json', ['groups' => 'element:read']);

        return new JsonResponse($jsonContent, 200, [], true);
    }
}