<?php

namespace App\Domain;

enum Type: string
{
    case PHYSICAL = 'PHYSICAL';

    case VIRTUAL = 'VIRTUAL';

    public function isPhysical(): bool
    {
        return $this === self::PHYSICAL;
    }

    public function isVirtual(): bool
    {
        return $this === self::VIRTUAL;
    }
}
