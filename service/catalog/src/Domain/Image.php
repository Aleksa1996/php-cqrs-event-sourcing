<?php

namespace App\Domain;

use App\Domain\Common\Id;
use App\Domain\Common\Entity;

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
