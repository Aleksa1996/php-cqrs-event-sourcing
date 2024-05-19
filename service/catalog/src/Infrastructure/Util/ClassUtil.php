<?php

namespace App\Infrastructure\Util;

class ClassUtil
{
    public static function short(object|string $objectOrClass): string
    {
        return (new \ReflectionClass($objectOrClass))->getShortName();
    }
}
