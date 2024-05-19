<?php

namespace App\Domain;

use App\Domain\Common\Id;
use App\Domain\Common\DomainEvent;
use App\Domain\Common\ImplementsDomainEvent;

class PriceChanged implements DomainEvent
{
    use ImplementsDomainEvent;

    public function __construct(Id $entityId, private readonly Price $price, int $domainEventVersion)
    {
        $this->entityId = $entityId;
        $this->domainEventVersion = $domainEventVersion;
        $this->occurredOn = new \DateTimeImmutable();
    }

    public function getDomainEventType(): string
    {
        return 'service.catalog.product.price_changed';
    }

    public function getPrice(): Price
    {
        return $this->price;
    }
}
