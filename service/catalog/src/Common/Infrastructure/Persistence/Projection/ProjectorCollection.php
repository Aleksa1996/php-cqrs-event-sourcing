<?php

namespace App\Common\Infrastructure\Persistence\Projection;

use App\Common\Domain\Event\DomainEvent;

class ProjectorCollection implements Projector
{
    public function __construct(private readonly array $projectors = []) {}

    public function project(DomainEvent $event): void
    {
        foreach ($this->projectors as $projector) {
            $projector->project($event);
        }
    }
}
