<?php

namespace App\Catalog\Infrastructure\Port\In\Controller;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

class ProductRequest
{
    public function __construct(
        #[Assert\Uuid]
        public ?string $id,
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[Assert\Length(min: 3, max: 50)]
        public readonly string $name,
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[Assert\Length(min: 5, max: 200)]
        public readonly string $description,
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[Assert\Regex(pattern: '/^PRO-[0-9]+$/')]
        public readonly string $pid,
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[Assert\Choice(['PHYSICAL', 'VIRTUAL'])]
        public readonly string $type,
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[Assert\Choice(['IN_DEVELOPMENT', 'FOR_SALE', 'OUT_OF_STOCK', 'LEGACY'])]
        public readonly string $status,
        #[Assert\NotBlank]
        #[Assert\Type('float')]
        public readonly float $price
    ) {
        $this->id ??= (string) Uuid::v4();
    }
}
