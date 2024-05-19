<?php

namespace App\Domain\Common;

trait ImplementsDomainEvent
{
    private Id $entityId;

    private int $domainEventVersion = 0;

    private \DateTimeImmutable $occurredOn;

    public function getEntityId(): Id
    {
        return $this->entityId;
    }

    public function getDomainEventVersion(): int
    {
        return $this->domainEventVersion;
    }

    public function getOccurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
