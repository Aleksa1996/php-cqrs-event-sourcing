<?php

namespace App\Catalog\Domain\Product;

enum Status: string
{
    case IN_DEVELOPMENT = 'IN_DEVELOPMENT';

    case FOR_SALE = 'FOR_SALE';

    case OUT_OF_STOCK = 'OUT_OF_STOCK';

    case LEGACY = 'LEGACY';

    public function isInDevelopment(): bool
    {
        return $this === self::IN_DEVELOPMENT;
    }

    public function isForSale(): bool
    {
        return $this === self::FOR_SALE;
    }

    public function isOutOfStock(): bool
    {
        return $this === self::OUT_OF_STOCK;
    }

    public function isLegacy(): bool
    {
        return $this === self::LEGACY;
    }
}
