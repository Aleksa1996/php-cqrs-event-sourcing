<?php

namespace App\Catalog\Infrastructure\Projection\Product;

use App\Catalog\Domain\Product\Created;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

class ProductEventListener
{
    #[AsMessageHandler]
    public function onUserCreated(Created $event): void
    {
        // TODO
        dump($event);
    }
}
