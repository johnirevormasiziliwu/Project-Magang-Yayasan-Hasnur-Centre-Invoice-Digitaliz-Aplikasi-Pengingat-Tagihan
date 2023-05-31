<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
=======
use Illuminate\Pagination\Paginator;
>>>>>>> 3768bfa9214ecabc56afb1cf983348da761a7225

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        //
=======
        Paginator::useBootstrapFive();
>>>>>>> 3768bfa9214ecabc56afb1cf983348da761a7225
    }
}
