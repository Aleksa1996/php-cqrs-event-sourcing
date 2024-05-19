<?php

namespace App\Common\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Types\Type;
use App\Common\Domain\Id as IdValueObject;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class Id extends Type
{
    public const NAME = 'uuid';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getGuidTypeDeclarationSQL($column);
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if ($value instanceof IdValueObject) {
            return $value;
        }

        if (!is_string($value) || $value === '') {
            return null;
        }

        try {
            return new IdValueObject($value);
        } catch (\InvalidArgumentException $e) {
            throw new ConversionException(sprintf('Could not convert value %s, type %s', $value, self::NAME));
        }
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($value instanceof IdValueObject) {
            return (string) $value;
        }

        if ((is_string($value) || (is_object($value) && $value instanceof \Stringable)) && IdValueObject::isValid((string) $value)) {
            return (string) $value;
        }

        throw new ConversionException(sprintf('Could not convert value %s, type %s', $value, self::NAME));
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
