<?php

namespace App\Domain;

use App\Domain\Common\Id;
use App\Domain\Common\Entity;

class Category extends Entity
{
    public function __construct(Id $id, private Id $categoryId, private bool $main)
    {
        parent::__construct($id);
    }

    public function getCategoryId(): Id
    {
        return $this->categoryId;
    }

    public function getMain(): bool
    {
        return $this->main;
    }
}
