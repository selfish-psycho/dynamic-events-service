<?php

namespace App\Shared\Services\DynamicManager;

use App\Shared\Contracts\BaseServiceInterface;
use App\Shared\Contracts\Dynamic\ServiceInterface;
use App\Shared\DI\Container;
use App\Shared\Enums\DynamicManager\ServicesEnums;
use App\Shared\Services\DynamicManager\BaseDynamic\BaseDynamicService;

class DynamicManagerService implements BaseServiceInterface
{
    /**
     * @inheritDoc
     */
    final public static function create(int $typeId = ServicesEnums::BASE->value): ServiceInterface
    {
        return match($typeId) {
            ServicesEnums::BASE->value => (new Container())->get(BaseDynamicService::class),
        };
    }
}
