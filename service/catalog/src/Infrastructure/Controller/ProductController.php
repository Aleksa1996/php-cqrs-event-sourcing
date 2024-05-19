<?php

namespace App\Infrastructure\Controller;

use App\Domain\Pid;
use App\Domain\Type;
use App\Domain\Price;
use App\Domain\Status;
use App\Domain\Product;
use App\Domain\Common\Id;
use App\Domain\PidPrefix;
use Symfony\Component\Uid\Uuid;
use App\Domain\ProductRepository;
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
    public function __construct(private readonly ProductRepository $productRepository) {}

    #[Route(methods: ['GET'], name: 'collection')]
    public function collection(#[MapQueryString] Query $query = new Query()): JsonResponse
    {
        // $this->productRepository->add(new Product(
        //     new Id(),
        //     'Product name',
        //     'Product description',
        //     new Pid(PidPrefix::PRO, 1),
        //     Type::PHYSICAL,
        //     Status::IN_DEVELOPMENT,
        //     new Price(13.50)
        // ));

        $product = $this->productRepository->get(new Id('3596d915-69d1-4f54-b880-47acd42c94a7'));
        dd($product);
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
