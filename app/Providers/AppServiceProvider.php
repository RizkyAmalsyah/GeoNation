<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
      // Registrasi NegaraInterface dengan implementasi NegaraRepository
      $this->app->bind(
        'App\Interfaces\NegaraInterface',
        'App\Repositories\NegaraRepository'
    );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
