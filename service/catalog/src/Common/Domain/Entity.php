<?php

namespace App\Common\Domain;

class Entity
{
    use Identity;

    public function __construct(Id $id)
    {
        $this->id = $id;
    }
}
