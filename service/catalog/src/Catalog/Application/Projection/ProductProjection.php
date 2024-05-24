<?php

namespace App\Catalog\Application\Projection;

class ProductProjection
{
    public function __construct(
        private string $id,
        private string $name,
        private string $description,
        private string $pid,
        private string $type,
        private string $status,
        private ?string $price,
        private \DateTimeImmutable $createdOn,
        private \DateTimeImmutable $updatedOn,
        private array $images = [],
        private array $categories = [],
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function getCreatedOn(): \DateTimeImmutable
    {
        return $this->createdOn;
    }

    public function getUpdatedOn(): \DateTimeImmutable
    {
        return $this->updatedOn;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function changeName(string $name): void
    {
        $this->name = $name;
    }

    public function changeDescription(string $description): void
    {
        $this->description = $description;
    }

    public function changePid(string $pid): void
    {
        $this->pid = $pid;
    }

    public function changePrice(?string $price): void
    {
        $this->price = $price;
    }

    public function changeType(string $type): void
    {
        $this->type = $type;
    }
}
