<?php

namespace App\Catalog\Domain\Product;

use App\Common\Domain\ValueObject;

class Price extends ValueObject
{
    public const SYMBOL = '$';

    public function __construct(private readonly float $number) {}

    public static function from(string $price): self
    {
        $p = str_replace(self::SYMBOL, '', $price);

        if (empty($p) || !is_numeric($p) || empty($number = floatval($p)) || $number < 0) {
            throw new \InvalidArgumentException('price.invalid.number');
        }

        return new self($number);
    }

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
