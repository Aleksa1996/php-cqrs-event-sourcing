<?php

namespace App\Catalog\Domain\Product;

use App\Common\Domain\ValueObject;

class Pid extends ValueObject
{
    public const SEPARATOR = '-';

    public function __construct(private readonly PidPrefix $prefix, private readonly int $number) {}

    public function getPrefix(): PidPrefix
    {
        return $this->prefix;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public static function from(string $pid): self
    {
        $e = explode(self::SEPARATOR, $pid);

        if (empty($e[0]) || empty($prefix = PidPrefix::tryFrom($e[0]))) {
            throw new \InvalidArgumentException('pid.invalid.prefix');
        }

        if (empty($e[1]) || !is_numeric($e[1]) || empty($number = intval($e[1])) || $number < 0) {
            throw new \InvalidArgumentException('pid.invalid.number');
        }

        return new self($prefix, $number);
    }

    public function __toString(): string
    {
        return sprintf('%s%s%s', $this->prefix->value, self::SEPARATOR, $this->number);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'prefix' => $this->prefix,
            'number' => $this->number,
        ];
    }

    public function equals(Pid $pid): bool
    {
        return $this->prefix === $pid->getPrefix() && $this->number === $pid->getNumber();
    }
}
