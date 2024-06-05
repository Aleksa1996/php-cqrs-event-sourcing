<?php

namespace App\Catalog\Application\Command;

use App\Common\Application\Bus\Command\Command;
use App\Common\Application\Bus\Command\TransactionalCommand;

class DestroyProductCommand extends Command implements TransactionalCommand
{
    public function __construct(
        private readonly string $id,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }
}
