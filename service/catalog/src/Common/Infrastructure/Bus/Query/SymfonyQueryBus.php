<?php

namespace App\Common\Infrastructure\Bus\Query;

use App\Common\Application\Bus\Query\QueryBus;
use App\Common\Application\Bus\Query\QueryResult;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyQueryBus implements QueryBus
{
    public function __construct(private readonly MessageBusInterface $messageBus) {}

    public function handle(object $command, array $stamps = []): QueryResult
    {
        $envelope = $this->messageBus->dispatch($command, $stamps);

        /**
         * @var HandledStamp[]
         */
        $handledStamps = $envelope->all(HandledStamp::class);

        if (empty($handledStamps) || empty($handledStamps[0]->getResult())) {
            return new QueryResult();
        }

        return $handledStamps[0]->getResult();
    }
}
