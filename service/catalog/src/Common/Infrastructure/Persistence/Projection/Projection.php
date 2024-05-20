<?php

namespace App\Common\Infrastructure\Persistence\Projection;

use App\Common\Domain\Event\DomainEvent;

interface Projection
{
    public function project(DomainEvent $event): void;
}
