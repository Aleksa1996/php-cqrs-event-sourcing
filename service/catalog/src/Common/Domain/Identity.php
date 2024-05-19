<?php

namespace App\Common\Domain;

trait Identity
{
    protected Id $id;

    public function getId(): Id
    {
        return $this->id;
    }
}
