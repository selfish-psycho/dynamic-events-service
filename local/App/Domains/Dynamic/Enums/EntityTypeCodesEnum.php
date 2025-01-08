<?php

namespace App\Domains\Dynamic\Enums;

enum EntityTypeCodesEnum: string
{
    case VISITS = '\App\Domains\Dynamic\Events\VisitEvents'; //ISR / IAM / Визиты

    public static function tryFromName(string $name)
    {
        return (new \ReflectionEnum(EntityTypeCodesEnum::class))->hasConstant($name) ?
            constant("self::$name") :
            null;
    }
}
