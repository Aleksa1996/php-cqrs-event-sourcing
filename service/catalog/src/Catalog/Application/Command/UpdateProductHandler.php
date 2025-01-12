<?php

namespace App\Catalog\Application\Command;

use App\Common\Domain\Id;
use App\Catalog\Domain\Product\Pid;
use App\Catalog\Domain\Product\Type;
use App\Catalog\Domain\Product\Price;
use App\Catalog\Domain\Product\Product;
use App\Catalog\Domain\Product\ProductRepository;
use App\Common\Application\Bus\Command\CommandResult;
use App\Common\Application\Bus\Command\CommandHandler;

class UpdateProductHandler implements CommandHandler
{
    public function __construct(private readonly ProductRepository $productRepository) {}

    public function __invoke(UpdateProductCommand $command): CommandResult
    {
        /**
         * @var Product|null
         */
        $product = $this->productRepository->get(new Id($command->getId()));

        if (empty($product)) {
            return new CommandResult();
        }

        $product->changeName($command->getName());
        $product->changeDescription($command->getDescription());
        $product->changePid(Pid::from($command->getPid()));
        $product->changeType(Type::from($command->getType()));
        // $product->changeStatus(Status::from($command->getStatus()));
        $product->changePrice(new Price($command->getPrice()));

        $this->productRepository->commit($product);

        return new CommandResult();
    }
}
