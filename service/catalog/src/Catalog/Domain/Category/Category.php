<?php

namespace App\Domain\Category;

use App\Common\Domain\Id;
use App\Common\Domain\Entity;

class Category extends Entity
{
    public function __construct(Id $id, private string $name, private Category $parent)
    {
        parent::__construct($id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParent(): Category
    {
        return $this->parent;
    }
}
