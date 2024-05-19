<?php

namespace App\Domain\Common;

interface AggregateRepository
{
    public function get(Id $id): AggregateRoot;

    public function add(AggregateRoot $aggregate): void;
}
