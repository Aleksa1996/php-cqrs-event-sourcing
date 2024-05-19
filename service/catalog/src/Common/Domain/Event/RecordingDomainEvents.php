<?php

namespace App\Common\Domain\Event;

interface RecordingDomainEvents
{
    public function dequeueRecordedDomainEvents(): array;
}
