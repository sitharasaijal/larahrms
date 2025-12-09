<?php

namespace Sithara\HrmsLaravel;

use Illuminate\Support\ServiceProvider;

class HrmsLaravelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    public function register()
    {
        // Register any bindings or services here
    }
}