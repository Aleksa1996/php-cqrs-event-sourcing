<?php

namespace App\Domain\Common;

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
            throw new \RuntimeException();
        }

        $this->optimisticConcurrencyVersion = $optimisticConcurrencyVersion;
    }

    protected function getNextOptimisticConcurrencyVersion(): int
    {
        return $this->optimisticConcurrencyVersion + count($this->recordedDomainEvents) + 1;
    }
}
