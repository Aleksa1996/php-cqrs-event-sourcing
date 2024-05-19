<?php

namespace App\Domain\Common;

interface RecordingDomainEvents
{
    public function dequeueRecordedDomainEvents(): array;
}
