<?php

namespace App\Infrastructure\Controller;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
#[Route('/products', name: 'products_')]
class ProductController extends AbstractController
{
    #[Route('/', methods: ['GET'], name: 'collection')]
    public function collection(#[MapQueryString] Query $query): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BaseController.php',
        ]);
    }

    #[Route('/{id}', methods: ['GET'], name: 'item', requirements: ['id' => Requirement::UUID_V4])]
    public function item(Uuid $id): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BaseController.php',
        ]);
    }

    #[Route('/', methods: ['POST'], name: 'create')]
    public function create(#[MapRequestPayload] ProductRequest $productRequest): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BaseController.php',
        ]);
    }

    #[Route('/{id}', methods: ['PUT'], name: 'update', requirements: ['id' => Requirement::UUID_V4])]
    public function update(#[MapRequestPayload] ProductRequest $productRequest): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BaseController.php',
        ]);
    }

    #[Route('/{id}', methods: ['DELETE'], name: 'destroy', requirements: ['id' => Requirement::UUID_V4])]
    public function destroy(Uuid $id): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BaseController.php',
        ]);
    }
}
