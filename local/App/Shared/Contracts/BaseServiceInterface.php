<?php

namespace App\Shared\Contracts;

interface BaseServiceInterface
{
    /**
     * Method create service by key.
     * @return mixed
     */
    public static function create(): self;
}
