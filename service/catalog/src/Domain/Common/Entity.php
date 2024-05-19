<?php

namespace App\Domain\Common;

class Entity
{
    use Identity;

    public function __construct(Id $id)
    {
        $this->id = $id;
    }
}
