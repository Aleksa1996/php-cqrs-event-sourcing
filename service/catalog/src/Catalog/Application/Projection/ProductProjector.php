<?php

namespace App\Catalog\Application\Projection;

use App\Catalog\Domain\Product\Created;
use App\Catalog\Domain\Product\Deleted;
use App\Catalog\Domain\Product\PidChanged;
use App\Catalog\Domain\Product\NameChanged;
use App\Catalog\Domain\Product\TypeChanged;
use App\Catalog\Domain\Product\PriceChanged;
use App\Catalog\Domain\Product\DescriptionChanged;
use App\Common\Infrastructure\Persistence\Projection\Projector;

interface ProductProjector extends Projector
{
    public function projectCreated(Created $domainEvent): void;

    public function projectNameChanged(NameChanged $domainEvent): void;

    public function projectDescriptionChanged(DescriptionChanged $domainEvent): void;

    public function projectPidChanged(PidChanged $domainEvent): void;

    public function projectTypeChanged(TypeChanged $domainEvent): void;

    // public function projectStatusChanged(StatusChanged $domainEvent): void;

    public function projectPriceChanged(PriceChanged $domainEvent): void;

    public function projectDeleted(Deleted $domainEvent): void;
}
