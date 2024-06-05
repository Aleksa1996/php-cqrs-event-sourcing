<?php

namespace App\Catalog\Application\Query;

use App\Common\Application\Bus\Query\QueryResult;
use App\Common\Application\Bus\Query\QueryHandler;
use App\Catalog\Application\Projection\ProductProjectionRepository;

class ProductCollectionQueryHandler implements QueryHandler
{
    public function __construct(private readonly ProductProjectionRepository $productProjectionRepository) {}

    public function __invoke(ProductCollectionQuery $query): QueryResult
    {
        $productProjections = $this->productProjectionRepository->query();

        return new QueryResult($productProjections, 1);
    }
}
