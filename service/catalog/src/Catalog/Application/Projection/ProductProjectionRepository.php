<?php

namespace App\Catalog\Application\Projection;

interface ProductProjectionRepository
{
    public function findById(string $id): ?ProductProjection;

    public function query(): array;

    public function commit(ProductProjection $productProjection): void;
}
