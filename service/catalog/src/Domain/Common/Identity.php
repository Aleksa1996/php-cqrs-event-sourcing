<?php

namespace App\Domain\Common;

trait Identity
{
    protected Id $id;

    public function getId(): Id
    {
        return $this->id;
    }
}
