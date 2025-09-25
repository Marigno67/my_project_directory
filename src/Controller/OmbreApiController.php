<?php

namespace App\Controller;

use App\Repository\OmbreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class OmbreApiController extends AbstractController
{
    #[Route('/api/ombres', name: 'app_ombre_list', methods: ['GET'])]
    public function list(OmbreRepository $ombreRepository, SerializerInterface $serializer): JsonResponse
    {
        $ombres = $ombreRepository->findBy([], ['nom' => 'ASC']);
        $jsonContent = $serializer->serialize($ombres, 'json', ['groups' => 'ombre:read']);

        return new JsonResponse($jsonContent, 200, [], true);
    }
}