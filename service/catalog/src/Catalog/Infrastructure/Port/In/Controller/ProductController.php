<?php

namespace App\Catalog\Infrastructure\Port\In\Controller;

use App\Common\Domain\Id;
use Symfony\Component\Uid\Uuid;
use App\Catalog\Domain\Product\Pid;
use App\Catalog\Domain\Product\Type;
use App\Catalog\Domain\Product\Price;
use App\Catalog\Domain\Product\Status;
use App\Catalog\Domain\Product\Product;
use App\Catalog\Domain\Product\PidPrefix;
use Symfony\Component\Routing\Attribute\Route;
use App\Catalog\Domain\Product\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsController]
#[Route('/api/v1/products', name: 'products_')]
class ProductController extends AbstractController
{
    public function __construct(private readonly ProductRepository $productRepository) {}

    #[Route(methods: ['GET'], name: 'collection')]
    public function collection(#[MapQueryString] Query $query = new Query()): JsonResponse
    {
        $this->productRepository->add(Product::create(
            new Id(),
            'Product name',
            'Product description',
            new Pid(PidPrefix::PRO, 1),
            Type::PHYSICAL,
            Status::IN_DEVELOPMENT,
            new Price(13.50)
        ));

        // $product = $this->productRepository->get(new Id('0b941490-08f9-4dcb-a072-a69958aaedb2'));

        // $product->changeName('Test');
        // $product->changePrice(new Price(1.2));
        // $product->changeDescription('heeeeeeeehe');
        // $this->productRepository->add($product);

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
