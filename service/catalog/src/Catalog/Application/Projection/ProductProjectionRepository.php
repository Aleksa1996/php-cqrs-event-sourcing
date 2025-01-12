<?php

namespace App\Catalog\Application\Projection;

interface ProductProjectionRepository
{
    public function findById(string $id): ?ProductProjection;

    public function query(array $criteria = []): array;

    public function count(array $criteria = []): int;

    public function commit(ProductProjection $productProjection): void;

    public function remove(ProductProjection $productProjection): void;
}
