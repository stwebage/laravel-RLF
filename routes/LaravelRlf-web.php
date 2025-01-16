<?php

use Illuminate\Support\Facades\Route;
use SmNet\LaravelRlf\Livewire\Panels\LaravelRlfLoginSystem;

Route::get('/rlfs', LaravelRlfLoginSystem::class)->middleware(['web'])->name('login');