<?php

namespace App\Infrastructure\Persistence\EventStore;

use App\Domain\Created;
use App\Domain\Common\Id;
use App\Domain\PidChanged;
use App\Domain\NameChanged;
use App\Domain\TypeChanged;
use App\Domain\PriceChanged;
use App\Domain\DescriptionChanged;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\Common\EventStore as IEventStore;
use App\Domain\Common\OptimisticLockingException;
use Symfony\Component\Serializer\SerializerInterface;

class EventStore implements IEventStore
{
    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly SerializerInterface $serializer) {}

    public function commit(Id $id, array $events, int $version): void
    {
        $lastStoredDomainEvent = $this->entityManager
            ->getRepository(StoredDomainEvent::class)
            ->findOneBy(['entityId' => $id], ['version' => 'desc']);

        if (!empty($lastStoredDomainEvent) && $version !== $lastStoredDomainEvent->getVersion()) {
            throw new OptimisticLockingException();
        }

        foreach ($events as $event) {
            $storedDomainEvent = new StoredDomainEvent(
                $event->getEntityId(),
                $event->getDomainEventVersion(),
                $event->getDomainEventType(),
                $this->serializer->serialize($event, 'json'),
                $event->getOccurredOn(),
            );

            $this->entityManager->persist($storedDomainEvent);
            $this->entityManager->flush();
        }
    }

    public function getEvents(Id $id): array
    {
        $storedDomainEvents = $this->entityManager->getRepository(StoredDomainEvent::class)->findAll();

        $events = [];

        foreach ($storedDomainEvents as $storedDomainEvent) {
            $event = $this->serializer->deserialize($storedDomainEvent->getBody(), self::mapToDomainEvent($storedDomainEvent), 'json');

            if (empty($event)) {
                throw new \RuntimeException();
            }

            $events[] = $event;
        }

        return $events;
    }

    private static function mapToDomainEvent(StoredDomainEvent $event): ?string
    {
        $mapping = [
            'service.catalog.product.created' => Created::class,
            'service.catalog.product.name_changed' => NameChanged::class,
            'service.catalog.product.description_changed' => DescriptionChanged::class,
            'service.catalog.product.pid_changed' => PidChanged::class,
            'service.catalog.product.price_changed' => PriceChanged::class,
            'service.catalog.product.type_changed' => TypeChanged::class,
        ];

        return $mapping[$event->getType()] ?? null;
    }
}
