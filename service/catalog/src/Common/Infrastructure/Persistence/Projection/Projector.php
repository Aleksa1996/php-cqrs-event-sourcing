<?php

namespace App\Common\Infrastructure\Persistence\Projection;

use App\Common\Domain\Event\DomainEvent;

interface Projector
{
    public function project(DomainEvent $event): void;
}
