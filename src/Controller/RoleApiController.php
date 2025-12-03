<?php

namespace App\Controller;

use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RoleApiController extends AbstractController
{
    #[Route('/api/roles', name: 'app_role_list', methods: ['GET'])]
    public function list(RoleRepository $roleRepository, SerializerInterface $serializer): JsonResponse
    {
        $roles = $roleRepository->findAll();
        // On utilise le groupe 'role:read' pour ne pas charger les personnages avec
        $jsonContent = $serializer->serialize($roles, 'json', ['groups' => 'role:read']);

        return new JsonResponse($jsonContent, 200, [], true);
    }
}
