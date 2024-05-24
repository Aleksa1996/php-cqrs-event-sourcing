<?php

namespace App\Common\Application\Bus\Event;

interface EventBus
{
    public function handle(object $event, array $stamps = []): void;
}
