<?php

namespace App\Common\Domain\Event;

trait DomainEventRecording
{
    protected array $recordedDomainEvents = [];

    public function dequeueRecordedDomainEvents(): array
    {
        $recordedDomainEvents = $this->recordedDomainEvents;

        $this->recordedDomainEvents = [];

        return $recordedDomainEvents;
    }

    protected function recordThat(DomainEvent $domainEvent): void
    {
        $this->recordedDomainEvents[] = $domainEvent;
    }
}
