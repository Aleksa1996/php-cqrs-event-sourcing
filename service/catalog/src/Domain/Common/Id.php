<?php

namespace App\Domain\Common;

use Symfony\Component\Uid\Uuid;

class Id extends ValueObject
{
    private string $id;

    public function __construct(?string $id = null)
    {
        if (is_null($id)) {
            $this->id = (string) Uuid::v4();

            return;
        }

        try {
            $this->id = Uuid::fromString($id);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException('id.not.valid');
        }
    }

    public static function isValid(string $id): bool
    {
        return Uuid::isValid($id);
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
        ];
    }
}
