<?php

namespace App\Common\Infrastructure\Bus\Event;

use App\Common\Application\Bus\Event\EventBus;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyEventBus implements EventBus
{
    public function __construct(private readonly MessageBusInterface $messageBus) {}

    public function handle(object $event, array $stamps = []): void
    {
        $this->messageBus->dispatch($event, $stamps);
    }
}
