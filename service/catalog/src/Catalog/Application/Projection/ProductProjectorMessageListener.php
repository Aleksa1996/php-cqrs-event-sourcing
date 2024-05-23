<?php

namespace App\Catalog\Application\Projection;

use App\Catalog\Domain\Product\Created;
use App\Catalog\Domain\Product\PidChanged;
use App\Catalog\Domain\Product\NameChanged;
use App\Catalog\Domain\Product\TypeChanged;
use App\Catalog\Domain\Product\PriceChanged;
use App\Catalog\Domain\Product\DescriptionChanged;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

class ProductProjectorMessageListener
{
    public function __construct(private readonly ProductProjector $productProjector) {}

    #[AsMessageHandler]
    public function onUserEvent(Created|NameChanged|DescriptionChanged|PidChanged|PriceChanged|TypeChanged $event): void
    {
        $this->productProjector->project($event);
    }
}
