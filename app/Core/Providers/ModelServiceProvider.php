<?php

namespace App\Core\Providers;

use App\Models\Company;
use App\Observers\CompanyObserver;
use Illuminate\Support\ServiceProvider;

/**
 * @codeCoverageIgnore
 */
class ModelServiceProvider extends ServiceProvider
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
        Company::observe(CompanyObserver::class);
    }
}
