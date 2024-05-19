<?php

namespace App\Domain;

use App\Domain\Common\ValueObject;

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
