<?php

namespace App\Infrastructure\Controller;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

class ProductRequest
{
    public function __construct(
        #[Assert\Uuid]
        public ?string $id,
        #[Assert\NotBlank]
        public readonly ?string $name,
    ) {
        $this->id ??= (string) Uuid::v4();
    }
}
