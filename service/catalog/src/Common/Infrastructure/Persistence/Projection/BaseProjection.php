<?php

namespace App\Common\Infrastructure\Persistence\Projection;

use App\Common\Util\ClassUtil;
use App\Common\Domain\Event\DomainEvent;

abstract class BaseProjection implements Projection
{
    public function project(DomainEvent $domainEvent): void
    {
        $method = 'project' . ClassUtil::short($domainEvent);
        call_user_func([$this, $method], $domainEvent);
    }
}
