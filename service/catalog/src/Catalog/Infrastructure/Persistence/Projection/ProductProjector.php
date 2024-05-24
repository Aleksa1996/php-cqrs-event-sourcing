<?php

namespace App\Catalog\Infrastructure\Persistence\Projection;

use App\Catalog\Domain\Product\Created;
use App\Catalog\Domain\Product\PidChanged;
use App\Catalog\Domain\Product\NameChanged;
use App\Catalog\Domain\Product\TypeChanged;
use App\Catalog\Domain\Product\PriceChanged;
use App\Catalog\Domain\Product\DescriptionChanged;
use App\Catalog\Application\Projection\ProductProjection;
use App\Catalog\Application\Projection\ProductProjectionRepository;
use App\Common\Infrastructure\Persistence\Projection\BaseProjector;
use App\Catalog\Application\Projection\ProductProjector as IProductProjector;

class ProductProjector extends BaseProjector implements IProductProjector
{
    public function __construct(private readonly ProductProjectionRepository $productProjectionRepository) {}

    public function projectCreated(Created $domainEvent): void
    {
        $productProjection = new ProductProjection(
            (string) $domainEvent->getEntityId(),
            $domainEvent->getName(),
            $domainEvent->getDescription(),
            (string) $domainEvent->getPid(),
            $domainEvent->getType()->value,
            $domainEvent->getStatus()->value,
            (string) $domainEvent->getPrice(),
            $domainEvent->getOccurredOn(),
            $domainEvent->getOccurredOn(),
        );

        $this->productProjectionRepository->commit($productProjection);
    }

    public function projectNameChanged(NameChanged $domainEvent): void
    {
        $productProjection = $this->productProjectionRepository->findById((string) $domainEvent->getEntityId());

        if (empty($productProjection)) {
            return;
        }

        $productProjection->changeName($domainEvent->getName());

        $this->productProjectionRepository->commit($productProjection);
    }

    public function projectDescriptionChanged(DescriptionChanged $domainEvent): void
    {
        $productProjection = $this->productProjectionRepository->findById((string) $domainEvent->getEntityId());

        if (empty($productProjection)) {
            return;
        }

        $productProjection->changeDescription($domainEvent->getDescription());

        $this->productProjectionRepository->commit($productProjection);
    }

    public function projectPidChanged(PidChanged $domainEvent): void
    {
        $productProjection = $this->productProjectionRepository->findById((string) $domainEvent->getEntityId());

        if (empty($productProjection)) {
            return;
        }

        $productProjection->changePid((string) $domainEvent->getPid());

        $this->productProjectionRepository->commit($productProjection);
    }

    public function projectTypeChanged(TypeChanged $domainEvent): void
    {
        $productProjection = $this->productProjectionRepository->findById((string) $domainEvent->getEntityId());

        if (empty($productProjection)) {
            return;
        }

        $productProjection->changeType($domainEvent->getType()->value);

        $this->productProjectionRepository->commit($productProjection);
    }

    // public function projectStatusChanged(StatusChanged $domainEvent): void
    // {
    //     $productProjection = $this->productProjectionRepository->findById((string)$domainEvent->getEntityId());

    //     if (empty($productProjection)) {
    //         return;
    //     }

    //     $productProjection->changeType($domainEvent->getType()->value);

    //     $this->productProjectionRepository->commit($productProjection);
    // }

    public function projectPriceChanged(PriceChanged $domainEvent): void
    {
        $productProjection = $this->productProjectionRepository->findById((string) $domainEvent->getEntityId());

        if (empty($productProjection)) {
            return;
        }

        $productProjection->changePrice((string) $domainEvent->getPrice());

        $this->productProjectionRepository->commit($productProjection);
    }
}
