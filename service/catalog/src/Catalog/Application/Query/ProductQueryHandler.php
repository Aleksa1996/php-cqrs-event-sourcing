<?php

namespace App\Catalog\Application\Query;

use App\Common\Application\Bus\Query\QueryResult;
use App\Common\Application\Bus\Query\QueryHandler;
use App\Catalog\Application\Projection\ProductProjectionRepository;

class ProductQueryHandler implements QueryHandler
{
    public function __construct(private readonly ProductProjectionRepository $productProjectionRepository) {}

    public function __invoke(ProductQuery $query): QueryResult
    {
        $productProjection = $this->productProjectionRepository->findById($query->getId());

        return new QueryResult([$productProjection], 1);
    }
}
