<?php

namespace App\Common\Application\Bus\Query;

abstract class CollectionQuery extends Query
{
    public function __construct(private readonly int $page = 1, private readonly int $limit = 10, private readonly array $filter = [], private readonly array $order = []) {}

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getFilter(): array
    {
        return $this->filter;
    }

    public function getOrder(): array
    {
        return $this->order;
    }
}
