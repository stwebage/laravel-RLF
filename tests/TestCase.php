<?php

namespace SmNet\LaravelRlf\Tests;

use SmNet\LaravelRlf\Providers\LaravelRlfServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelRlfServiceProvider::class,
        ];
    }
}