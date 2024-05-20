<?php

namespace App\Catalog\Infrastructure\Projection\Product;

use App\Catalog\Domain\Product\Created;
use App\Catalog\Domain\Product\PidChanged;
use App\Catalog\Domain\Product\NameChanged;
use App\Catalog\Domain\Product\TypeChanged;
use App\Catalog\Domain\Product\PriceChanged;
use App\Catalog\Domain\Product\DescriptionChanged;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

class ProductMessageListener
{
    public function __construct(private readonly ProductProjection $productProjection) {}

    #[AsMessageHandler]
    public function onUserEvent(Created|NameChanged|DescriptionChanged|PidChanged|PriceChanged|TypeChanged $event): void
    {
        $this->productProjection->project($event);
    }
}
