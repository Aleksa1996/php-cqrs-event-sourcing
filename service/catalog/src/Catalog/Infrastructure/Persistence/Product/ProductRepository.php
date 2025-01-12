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
        $events = $this->eventStore->get($id);

        if (empty($events)) {
            return null;
        }

        return Product::reconstruct($events);
    }

    public function commit(AggregateRoot $aggregate): void
    {
        $events = $aggregate->dequeueRecordedDomainEvents();

        $this->eventStore->commit($aggregate->getId(), $events, $aggregate->getOptimisticConcurrencyVersion());
    }
}
