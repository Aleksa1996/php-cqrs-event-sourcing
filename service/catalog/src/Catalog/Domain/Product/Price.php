<?php

namespace App\Catalog\Domain\Product;

use App\Common\Domain\ValueObject;

class Price extends ValueObject
{
    public const SYMBOL = '$';

    public function __construct(private readonly float $number) {}

    public function __toString(): string
    {
        return sprintf('%s%s', self::SYMBOL, number_format($this->number, 2));
    }

    public function jsonSerialize(): mixed
    {
        return [
            'number' => $this->number,
        ];
    }
}
