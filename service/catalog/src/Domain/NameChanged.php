<?php

namespace App\Domain;

use App\Domain\Common\Id;
use App\Domain\Common\DomainEvent;
use App\Domain\Common\ImplementsDomainEvent;

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
