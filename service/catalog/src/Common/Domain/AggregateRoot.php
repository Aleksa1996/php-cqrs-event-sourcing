<?php

namespace App\Common\Domain;

use App\Common\Domain\Event\DomainEventRecording;
use App\Common\Domain\Event\RecordingDomainEvents;

abstract class AggregateRoot extends Entity implements RecordingDomainEvents
{
    use DomainEventRecording;

    protected int $optimisticConcurrencyVersion = 0;

    public function getOptimisticConcurrencyVersion(): int
    {
        return $this->optimisticConcurrencyVersion;
    }

    protected function setOptimisticConcurrencyVersion(int $optimisticConcurrencyVersion): void
    {
        if ($optimisticConcurrencyVersion <= $this->optimisticConcurrencyVersion) {
            throw new \RuntimeException('version.lower.than.current');
        }

        $this->optimisticConcurrencyVersion = $optimisticConcurrencyVersion;
    }

    protected function getNextOptimisticConcurrencyVersion(): int
    {
        return $this->optimisticConcurrencyVersion + count($this->recordedDomainEvents) + 1;
    }
}
