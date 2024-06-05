<?php

namespace App\Catalog\Application\Query;

use App\Common\Application\Bus\Query\Query;

class ProductQuery extends Query
{
    public function __construct(private readonly string $id) {}

    public function getId(): string
    {
        return $this->id;
    }
}
