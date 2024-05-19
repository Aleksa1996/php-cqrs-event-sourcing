<?php

namespace App\Domain\Common;

interface EventStore
{
    public function commit(Id $id, array $events, int $version): void;

    public function getEvents(Id $id): array;
}
