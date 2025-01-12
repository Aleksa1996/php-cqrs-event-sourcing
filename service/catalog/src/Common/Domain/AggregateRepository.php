<?php

namespace App\Common\Domain;

interface AggregateRepository
{
    public function get(Id $id): ?AggregateRoot;

    public function remove(AggregateRoot $aggregate): void;

    public function commit(AggregateRoot $aggregate): void;
}
