<?php

namespace App\Infrastructure\Controller;

use Symfony\Component\Validator\Constraints as Assert;

class Query
{
    public function __construct(
        #[Assert\Type('int')]
        #[Assert\LessThanOrEqual(100)]
        #[Assert\GreaterThanOrEqual(1)]
        public readonly int $size = 25,
        #[Assert\Type('int')]
        #[Assert\GreaterThanOrEqual(1)]
        public readonly int $page = 1,
    ) {}
}
