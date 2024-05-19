<?php

namespace App\Domain;

use App\Domain\Common\Id;
use App\Domain\Common\DomainEvent;
use App\Domain\Common\ImplementsDomainEvent;

class DescriptionChanged implements DomainEvent
{
    use ImplementsDomainEvent;

    public function __construct(Id $entityId, private readonly string $description, int $domainEventVersion)
    {
        $this->entityId = $entityId;
        $this->domainEventVersion = $domainEventVersion;
        $this->occurredOn = new \DateTimeImmutable();
    }

    public function getDomainEventType(): string
    {
        return 'service.catalog.product.description_changed';
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
