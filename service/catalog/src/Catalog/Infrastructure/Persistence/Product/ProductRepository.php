<?php

namespace App\Catalog\Infrastructure\Persistence\Product;

use App\Common\Domain\Id;
use App\Common\Domain\AggregateRoot;
use App\Catalog\Domain\Product\Product;
use App\Common\Domain\Event\EventStore;
use App\Catalog\Domain\Product\ProductRepository as IProductRepository;

class ProductRepository implements IProductRepository
{
    public function __construct(private readonly EventStore $eventStore) {}

    public function get(Id $id): ?AggregateRoot
    {
        $domainEvents = $this->eventStore->getEvents($id);

        if (empty($domainEvents)) {
            return null;
        }

        return Product::reconstruct($domainEvents);
    }

    public function add(AggregateRoot $aggregate): void
    {
        $domainEvents = $aggregate->dequeueRecordedDomainEvents();

        $this->eventStore->commit($aggregate->getId(), $domainEvents, $aggregate->getOptimisticConcurrencyVersion());
        // $this->postProjection->project($domainEvents);
    }
}
