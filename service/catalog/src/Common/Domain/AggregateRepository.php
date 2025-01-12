<?php

namespace App\Common\Domain;

interface AggregateRepository
{
    public function get(Id $id): ?AggregateRoot;

    public function commit(AggregateRoot $aggregate): void;
}
