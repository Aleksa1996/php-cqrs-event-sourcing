<?php

namespace App\Common\Infrastructure\Port\Out\EventStore;

use App\Common\Domain\Id;
use App\Catalog\Domain\Product\Created;
use Doctrine\ORM\EntityManagerInterface;
use App\Catalog\Domain\Product\PidChanged;
use App\Catalog\Domain\Product\NameChanged;
use App\Catalog\Domain\Product\TypeChanged;
use App\Catalog\Domain\Product\PriceChanged;
use App\Common\Application\Bus\Event\EventBus;
use App\Common\Domain\OptimisticLockingException;
use App\Catalog\Domain\Product\DescriptionChanged;
use Symfony\Component\Serializer\SerializerInterface;
use App\Common\Domain\Event\EventStore as IEventStore;
use Symfony\Component\Messenger\Stamp\TransportNamesStamp;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

class EventStore implements IEventStore
{
    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly SerializerInterface $serializer, private readonly EventBus $eventBus) {}

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
        }

        $this->publish($events);
    }

    public function get(Id $id): array
    {
        $storedDomainEvents = $this->entityManager->getRepository(StoredDomainEvent::class)->findBy(['entityId' => $id], ['version' => 'asc']);

        $events = [];

        foreach ($storedDomainEvents as $storedDomainEvent) {
            $event = $this->serializer->deserialize($storedDomainEvent->getBody(), self::mapToDomainEvent($storedDomainEvent), 'json');

            if (empty($event)) {
                throw new \RuntimeException('event.not.deserialized');
            }

            $events[] = $event;
        }

        return $events;
    }

    private static function mapToDomainEvent(StoredDomainEvent $event): string
    {
        $mapping = [
            'service.catalog.product.created' => Created::class,
            'service.catalog.product.name_changed' => NameChanged::class,
            'service.catalog.product.description_changed' => DescriptionChanged::class,
            'service.catalog.product.pid_changed' => PidChanged::class,
            'service.catalog.product.price_changed' => PriceChanged::class,
            'service.catalog.product.type_changed' => TypeChanged::class,
        ];

        if (!isset($mapping[$event->getType()])) {
            throw new \RuntimeException('event.alias.not.mapped');
        }

        return $mapping[$event->getType()];
    }

    private function publish(array $events): void
    {
        foreach ($events as $event) {
            $this->eventBus->handle(
                $event,
                [new DispatchAfterCurrentBusStamp(), new TransportNamesStamp('event_store')]
            );
        }
    }
}
