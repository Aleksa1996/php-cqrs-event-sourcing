<?php

namespace App\Catalog\Infrastructure\Port\In\Controller;

use Symfony\Component\Uid\Uuid;
use App\Common\Application\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Catalog\Application\Query\ProductQuery;
use App\Common\Application\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\HttpKernel\Attribute\AsController;
use App\Catalog\Application\Command\CreateProductCommand;
use App\Catalog\Application\Command\UpdateProductCommand;
use App\Catalog\Application\Query\ProductCollectionQuery;
use App\Catalog\Application\Command\DestroyProductCommand;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[AsController]
#[Route('/api/v1/products', name: 'products_', format: 'json')]
class ProductController extends AbstractController
{
    public function __construct(private readonly QueryBus $queryBus, private readonly CommandBus $commandBus) {}

    #[Route(methods: ['GET'], name: 'collection')]
    public function collection(#[MapQueryString] Query $query = new Query()): JsonResponse
    {
        $result = $this->queryBus->handle(new ProductCollectionQuery($query->page, $query->limit));

        return $this->json($result->getResult(), Response::HTTP_OK);
    }

    #[Route('/{id}', methods: ['GET'], name: 'item', requirements: ['id' => Requirement::UUID_V4])]
    public function item(Uuid $id): JsonResponse
    {
        $result = $this->queryBus->handle(new ProductQuery((string) $id));

        if (empty($result->getFirst())) {
            throw new NotFoundHttpException('product.not.found');
        }

        return $this->json($result->getFirst(), Response::HTTP_OK);
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

        return $this->json($productRequest, Response::HTTP_CREATED);
    }

    #[Route('/{id}', methods: ['PUT'], name: 'update', requirements: ['id' => Requirement::UUID_V4])]
    public function update(Uuid $id, #[MapRequestPayload] ProductRequest $productRequest): JsonResponse
    {
        $this->commandBus->handle(
            new UpdateProductCommand(
                (string) $id,
                $productRequest->name,
                $productRequest->description,
                $productRequest->pid,
                $productRequest->type,
                $productRequest->status,
                $productRequest->price,
            )
        );

        return $this->json($productRequest, Response::HTTP_OK);
    }

    #[Route('/{id}', methods: ['DELETE'], name: 'destroy', requirements: ['id' => Requirement::UUID_V4])]
    public function destroy(Uuid $id): JsonResponse
    {
        $this->commandBus->handle(new DestroyProductCommand((string) $id));

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
