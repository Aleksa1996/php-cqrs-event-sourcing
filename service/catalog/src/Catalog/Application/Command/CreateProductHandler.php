<?php

namespace App\Catalog\Application\Command;

use App\Common\Domain\Id;
use App\Catalog\Domain\Product\Pid;
use App\Catalog\Domain\Product\Type;
use App\Catalog\Domain\Product\Price;
use App\Catalog\Domain\Product\Status;
use App\Catalog\Domain\Product\Product;
use App\Catalog\Domain\Product\ProductRepository;
use App\Common\Application\Bus\Command\CommandResult;
use App\Common\Application\Bus\Command\CommandHandler;

class CreateProductHandler implements CommandHandler
{
    public function __construct(private readonly ProductRepository $productRepository) {}

    public function __invoke(CreateProductCommand $command): CommandResult
    {
        $product = Product::create(
            new Id($command->getId()),
            $command->getName(),
            $command->getDescription(),
            Pid::from($command->getPid()),
            Type::from($command->getType()),
            Status::from($command->getStatus()),
            new Price($command->getPrice())
        );

        $this->productRepository->commit($product);

        return new CommandResult();
    }
}
