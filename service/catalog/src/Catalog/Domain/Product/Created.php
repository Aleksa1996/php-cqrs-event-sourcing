<?php

namespace App\Catalog\Domain\Product;

use App\Common\Domain\Id;
use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Event\ImplementsDomainEvent;

class Created implements DomainEvent
{
    use ImplementsDomainEvent;

    public function __construct(
        Id $entityId,
        private readonly string $name,
        private readonly string $description,
        private readonly Pid $pid,
        private readonly Type $type,
        private readonly Status $status,
        private readonly ?Price $price,
        int $domainEventVersion
    ) {
        $this->entityId = $entityId;
        $this->domainEventVersion = $domainEventVersion;
        $this->occurredOn = new \DateTimeImmutable();
    }

    public function getDomainEventType(): string
    {
        return 'service.catalog.product.created';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPid(): Pid
    {
        return $this->pid;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getPrice(): ?Price
    {
        return $this->price;
    }
}
