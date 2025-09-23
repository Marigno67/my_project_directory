<?php

namespace App\Controller;

use App\Repository\SetArtefactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class SetArtefactApiController extends AbstractController
{
    #[Route('/api/sets-artefacts', name: 'app_set_artefact_list', methods: ['GET'])]
    public function list(SetArtefactRepository $setArtefactRepository, SerializerInterface $serializer): JsonResponse
    {
        $sets = $setArtefactRepository->findAll();
        $jsonContent = $serializer->serialize($sets, 'json', ['groups' => 'setArtefact:read']);

        return new JsonResponse($jsonContent, 200, [], true);
    }
}
