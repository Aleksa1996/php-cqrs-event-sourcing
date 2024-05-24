<?php

namespace App\Catalog\Domain\Product;

use App\Common\Domain\Id;
use App\Common\Domain\Entity;

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
