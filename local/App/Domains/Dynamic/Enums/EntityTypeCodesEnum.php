<?php

namespace App\Domains\Dynamic\Enums;

enum EntityTypeCodesEnum: string
{

    /**
     * Связь кода и неймспейса репозитория событий для элементов смарт-процесса "Посещения" для примера работы сервиса
     */
    case VISITS = '\App\Domains\Dynamic\Events\VisitEvents';

    public static function tryFromName(string $name)
    {
        return (new \ReflectionEnum(EntityTypeCodesEnum::class))->hasConstant($name) ?
            constant("self::$name") :
            null;
    }
}
