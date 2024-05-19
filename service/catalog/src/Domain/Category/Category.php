<?php

namespace App\Domain\Category;

use App\Domain\Common\Id;
use App\Domain\Common\Entity;

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
