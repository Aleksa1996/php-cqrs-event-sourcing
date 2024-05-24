<?php

namespace App\Catalog\Domain\Product;

use App\Common\Domain\Id;
use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Event\ImplementsDomainEvent;

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
