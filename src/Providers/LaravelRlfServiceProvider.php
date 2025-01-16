<?php

namespace SmNet\LaravelRlf\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use SmNet\LaravelRlf\Livewire\Panels\Includes\ForgotPassword;
use SmNet\LaravelRlf\Livewire\Panels\Includes\Login;
use SmNet\LaravelRlf\Livewire\Panels\Includes\Register;
use SmNet\LaravelRlf\Livewire\Panels\LaravelRlfLoginSystem;
use SmNet\LaravelRlf\Services\LaravelRlfService;

class LaravelRlfServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(LaravelRlfService::class, LaravelRlfService::class);
        $this->publishes([__DIR__ . '/../../config/LaravelRlf-config.php' => config_path('LaravelRlf-config.php'),],'LaravelRlf');
        Livewire::component('sm-net.laravel-rlf.livewire.panels.laravel-rlf-login-system', LaravelRlfLoginSystem::class);
        Livewire::component('login', Login::class);
        Livewire::component('register', Register::class);
        Livewire::component('forgotPassword', ForgotPassword::class);
    }
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/LaravelRlf-web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'LaravelRlf');

        $this->publishes([__DIR__.'/../../resources/views' => resource_path('views/vendor/LaravelRlf')], 'LaravelRlf-views');
        $this->publishes([__DIR__.'/../../public' => public_path('vendor/LaravelRlf')], 'LaravelRlf-public');
    }
}