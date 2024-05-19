<?php

namespace App\Domain;

use App\Domain\Common\Id;
use App\Domain\Common\DomainEvent;
use App\Domain\Common\ImplementsDomainEvent;

class PidChanged implements DomainEvent
{
    use ImplementsDomainEvent;

    public function __construct(Id $entityId, private readonly Pid $pid, int $domainEventVersion)
    {
        $this->entityId = $entityId;
        $this->domainEventVersion = $domainEventVersion;
        $this->occurredOn = new \DateTimeImmutable();
    }

    public function getDomainEventType(): string
    {
        return 'service.catalog.product.pid_changed';
    }

    public function getPid(): Pid
    {
        return $this->pid;
    }
}
