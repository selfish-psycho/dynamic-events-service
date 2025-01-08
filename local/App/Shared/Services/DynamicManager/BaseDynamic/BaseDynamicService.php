<?php

namespace App\Shared\Services\DynamicManager\BaseDynamic;

use App\Shared\Contracts\Dynamic\ActionsInterface;
use App\Shared\Contracts\Dynamic\ControllerInterface;
use App\Shared\Contracts\Dynamic\RepositoryInterface;
use App\Shared\Contracts\Dynamic\ServiceInterface;
use App\Shared\Services\DynamicManager\BaseDynamic\Actions\BaseDynamicActions;
use App\Shared\Services\DynamicManager\BaseDynamic\Controllers\BaseDynamicController;

readonly class BaseDynamicService implements ServiceInterface
{
    public function __construct(
        private BaseDynamicController $controller
    )
    {
    }

    public function actions(RepositoryInterface $repository): ActionsInterface
    {
        return new BaseDynamicActions($repository);
    }

    public function controller(): ControllerInterface
    {
        return $this->controller;
    }
}
