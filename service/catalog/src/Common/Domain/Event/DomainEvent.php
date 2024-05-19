<?php

namespace App\Common\Domain\Event;

use App\Common\Domain\Id;

interface DomainEvent
{
    public function getEntityId(): Id;

    public function getDomainEventVersion(): int;

    public function getDomainEventType(): string;

    public function getOccurredOn(): \DateTimeImmutable;
}
