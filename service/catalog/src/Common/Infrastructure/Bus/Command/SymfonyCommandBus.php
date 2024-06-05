<?php

namespace App\Common\Infrastructure\Bus\Command;

use App\Common\Application\Bus\Command\CommandBus;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Common\Application\Bus\Command\CommandResult;

class SymfonyCommandBus implements CommandBus
{
    public function __construct(private readonly MessageBusInterface $messageBus) {}

    public function handle(object $command, array $stamps = []): CommandResult
    {
        $envelope = $this->messageBus->dispatch($command, $stamps);

        /**
         * @var HandledStamp[]
         */
        $handledStamps = $envelope->all(HandledStamp::class);

        if (empty($handledStamps) || empty($handledStamps[0]->getResult())) {
            return new CommandResult();
        }

        return $handledStamps[0]->getResult();
    }
}
