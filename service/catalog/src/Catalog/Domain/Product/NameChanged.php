<?php

namespace App\Catalog\Domain\Product;

use App\Common\Domain\Id;
use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Event\ImplementsDomainEvent;

class NameChanged implements DomainEvent
{
    use ImplementsDomainEvent;

    public function __construct(Id $entityId, private readonly string $name, int $domainEventVersion)
    {
        $this->entityId = $entityId;
        $this->domainEventVersion = $domainEventVersion;
        $this->occurredOn = new \DateTimeImmutable();
    }

    public function getDomainEventType(): string
    {
        return 'service.catalog.product.name_changed';
    }

    public function getName(): string
    {
        return $this->name;
    }
}
