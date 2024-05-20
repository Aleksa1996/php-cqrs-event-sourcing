<?php

namespace App\Catalog\Infrastructure\Projection\Product;

use App\Catalog\Domain\Product\Created;
use App\Common\Infrastructure\Persistence\Projection\BaseProjection;

class ProductProjection extends BaseProjection
{
    public function projectCreated(Created $created): void
    {
        dump($created);
    }
}
