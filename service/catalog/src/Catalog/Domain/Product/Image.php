<?php

namespace App\Catalog\Domain\Product;

use App\Common\Domain\Id;
use App\Common\Domain\Entity;

class Image extends Entity
{
    public function __construct(Id $id, private string $name, private string $description, private string $src)
    {
        parent::__construct($id);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSrc(): string
    {
        return $this->src;
    }
}
