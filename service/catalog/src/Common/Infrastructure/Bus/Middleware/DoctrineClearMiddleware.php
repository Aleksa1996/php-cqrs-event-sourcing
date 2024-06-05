<?php

namespace App\Common\Infrastructure\Bus\Middleware;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;

class DoctrineClearMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly ManagerRegistry $managerRegistry) {}

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        try {
            return $stack->next()->handle($envelope, $stack);
        } finally {
            $this->clearEntityManagers();
        }
    }

    private function clearEntityManagers(): void
    {
        foreach ($this->managerRegistry->getManagers() as $manager) {
            $manager->clear();
        }
    }
}
