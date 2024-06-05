<?php

namespace App\Catalog\Application\Command;

use App\Common\Application\Bus\Command\Command;
use App\Common\Application\Bus\Command\TransactionalCommand;

class CreateProductCommand extends Command implements TransactionalCommand
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly string $description,
        private readonly string $pid,
        private readonly string $type,
        private readonly string $status,
        private readonly float $price,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPid(): string
    {
        return $this->pid;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
