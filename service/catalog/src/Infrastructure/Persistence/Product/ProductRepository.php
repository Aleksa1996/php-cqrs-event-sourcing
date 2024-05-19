<?php

namespace App\Infrastructure\Persistence\Product;

use App\Domain\Product;
use App\Domain\Common\Id;
use App\Domain\Common\EventStore;
use App\Domain\Common\AggregateRoot;
use App\Domain\ProductRepository as IProductRepository;

class ProductRepository implements IProductRepository
{
    public function __construct(private readonly EventStore $eventStore) {}

    public function get(Id $id): AggregateRoot
    {
        $domainEvents = $this->eventStore->getEvents($id);

        return Product::reconstruct($domainEvents);
    }

    public function add(AggregateRoot $aggregate): void
    {
        $domainEvents = $aggregate->dequeueRecordedDomainEvents();

        $this->eventStore->commit($aggregate->getId(), $domainEvents, $aggregate->getOptimisticConcurrencyVersion());
        // $this->postProjection->project($domainEvents);
    }
}
