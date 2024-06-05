<?php

namespace App\Catalog\Application\Command;

use App\Common\Domain\Id;
use App\Catalog\Domain\Product\ProductRepository;
use App\Common\Application\Bus\Command\CommandResult;
use App\Common\Application\Bus\Command\CommandHandler;

class DestroyProductHandler implements CommandHandler
{
    public function __construct(private readonly ProductRepository $productRepository) {}

    public function __invoke(DestroyProductCommand $command): CommandResult
    {
        $product = $this->productRepository->get(new Id($command->getId()));

        if (empty($product)) {
            return new CommandResult();
        }

        $this->productRepository->remove($product);

        return new CommandResult();
    }
}
