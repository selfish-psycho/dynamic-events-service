<?php

namespace App\Shared\Contracts\Dynamic;

use \App\Shared\Contracts\Dynamic\RepositoryInterface;

interface ControllerInterface
{
    public static function setRepository(RepositoryInterface $repository): void;
    public static function getRepository(): RepositoryInterface;
}
