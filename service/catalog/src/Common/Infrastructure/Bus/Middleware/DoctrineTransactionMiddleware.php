<?php

namespace App\Common\Infrastructure\Bus\Middleware;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\Middleware\StackInterface;
use App\Common\Application\Bus\Command\TransactionalCommand;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\UnrecoverableMessageHandlingException;

class DoctrineTransactionMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly ManagerRegistry $managerRegistry, private readonly ?string $entityManagerName = null) {}

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        if (!$envelope->getMessage() instanceof TransactionalCommand) {
            return $stack->next()->handle($envelope, $stack);
        }

        try {
            $entityManager = $this->managerRegistry->getManager($this->entityManagerName);
        } catch (\InvalidArgumentException $e) {
            throw new UnrecoverableMessageHandlingException($e->getMessage(), 0, $e);
        }

        // @phpstan-ignore-next-line
        return $this->handleForManager($entityManager, $envelope, $stack);
    }

    protected function handleForManager(EntityManagerInterface $entityManager, Envelope $envelope, StackInterface $stack): Envelope
    {
        $entityManager->getConnection()->beginTransaction();

        try {
            $envelope = $stack->next()->handle($envelope, $stack);
            $entityManager->flush();
            $entityManager->getConnection()->commit();

            return $envelope;
        } catch (\Throwable $exception) {
            $entityManager->getConnection()->rollBack();

            if ($exception instanceof HandlerFailedException) {
                // Remove all HandledStamp from the envelope so the retry will execute all handlers again.
                // When a handler fails, the queries of allegedly successful previous handlers just got rolled back.
                throw new HandlerFailedException($exception->getEnvelope()->withoutAll(HandledStamp::class), $exception->getWrappedExceptions());
            }

            throw $exception;
        }
    }
}
