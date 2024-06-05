<?php

namespace App\Catalog\Infrastructure\Port\In\Controller;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Routing\Attribute\Route;
use App\Common\Application\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\HttpKernel\Attribute\AsController;
use App\Catalog\Application\Command\CreateProductCommand;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
#[Route('/api/v1/products', name: 'products_')]
class ProductController extends AbstractController
{
    public function __construct(private readonly CommandBus $commandBus) {}

    #[Route(methods: ['GET'], name: 'collection')]
    public function collection(#[MapQueryString] Query $query = new Query()): JsonResponse
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

    #[Route(methods: ['POST'], name: 'create')]
    public function create(#[MapRequestPayload] ProductRequest $productRequest): JsonResponse
    {
        $this->commandBus->handle(
            new CreateProductCommand(
                $productRequest->id,
                $productRequest->name,
                $productRequest->description,
                $productRequest->pid,
                $productRequest->type,
                $productRequest->status,
                $productRequest->price,
            )
        );

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
