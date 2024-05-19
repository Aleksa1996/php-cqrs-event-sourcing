<?php

namespace App\Domain;

use App\Domain\Common\Id;
use App\Domain\Common\DomainEvent;
use App\Domain\Common\ImplementsDomainEvent;

class TypeChanged implements DomainEvent
{
    use ImplementsDomainEvent;

    public function __construct(Id $entityId, private readonly Type $type, int $domainEventVersion)
    {
        $this->entityId = $entityId;
        $this->domainEventVersion = $domainEventVersion;
        $this->occurredOn = new \DateTimeImmutable();
    }

    public function getDomainEventType(): string
    {
        return 'service.catalog.product.type_changed';
    }

    public function getType(): Type
    {
        return $this->type;
    }
}
