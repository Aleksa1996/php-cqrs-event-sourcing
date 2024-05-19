<?php

namespace App\Infrastructure\Persistence\Doctrine\Type;

use App\Domain\Common\Id;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class IdType extends Type
{
    public const NAME = 'uuid';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getGuidTypeDeclarationSQL($column);
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if ($value instanceof Id) {
            return $value;
        }

        if (!is_string($value) || $value === '') {
            return null;
        }

        try {
            return new Id($value);
        } catch (\InvalidArgumentException $e) {
            throw new ConversionException(sprintf('Could not convert value %s, type %s', $value, self::NAME));
        }
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($value instanceof Id) {
            return (string) $value;
        }

        if ((is_string($value) || (is_object($value) && $value instanceof \Stringable)) && Id::isValid((string) $value)) {
            return (string) $value;
        }

        throw new ConversionException(sprintf('Could not convert value %s, type %s', $value, self::NAME));
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
