<?php

namespace App\Domain\Common;

interface DomainEvent
{
    public function getEntityId(): Id;

    public function getDomainEventVersion(): int;

    public function getDomainEventType(): string;

    public function getOccurredOn(): \DateTimeImmutable;
}
