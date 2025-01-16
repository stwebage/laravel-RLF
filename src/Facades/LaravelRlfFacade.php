<?php

namespace SmNet\LaravelRlf\Facades;

use Illuminate\Support\Facades\Facade;
use SmNet\LaravelRlf\Services\LaravelRlfService;

class LaravelRlfFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LaravelRlfService::class;
    }
}