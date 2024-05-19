<?php

namespace App\Common\Domain\Event;

use App\Common\Domain\Id;

interface EventStore
{
    public function commit(Id $id, array $events, int $version): void;

    public function getEvents(Id $id): array;
}
