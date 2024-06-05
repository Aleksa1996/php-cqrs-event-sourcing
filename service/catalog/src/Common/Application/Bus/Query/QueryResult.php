<?php

namespace App\Common\Application\Bus\Query;

use App\Common\Util\ArrUtil;

class QueryResult
{
    public function __construct(private readonly ?array $result = [], private readonly int $total = 0) {}

    public function getResult(): array
    {
        return $this->result;
    }

    public function getFirst(): mixed
    {
        return ArrUtil::first($this->result);
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function isEmpty(): bool
    {
        return empty($this->result);
    }
}
