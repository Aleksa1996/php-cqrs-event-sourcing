<?php

namespace App\Catalog\Infrastructure\Projection\Product;

use App\Catalog\Domain\Product\Created;
use App\Catalog\Domain\Product\PidChanged;
use App\Catalog\Domain\Product\NameChanged;
use App\Catalog\Domain\Product\TypeChanged;
use App\Catalog\Domain\Product\PriceChanged;
use App\Catalog\Domain\Product\DescriptionChanged;
use App\Common\Infrastructure\Persistence\Projection\BaseProjection;

class ProductProjection extends BaseProjection
{
    public function projectCreated(Created $domainEvent): void
    {
        // TODO
        dump($domainEvent);
    }

    public function projectNameChanged(NameChanged $domainEvent): void
    {
        // TODO
        dump($domainEvent);
    }

    public function projectDescriptionChanged(DescriptionChanged $domainEvent): void
    {
        // TODO
        dump($domainEvent);
    }

    public function projectPidChanged(PidChanged $domainEvent): void
    {
        // TODO
        dump($domainEvent);
    }

    public function projectPriceChanged(PriceChanged $domainEvent): void
    {
        // TODO
        dump($domainEvent);
    }

    public function projectTypeChanged(TypeChanged $domainEvent): void
    {
        // TODO
        dump($domainEvent);
    }
}
