<?php

namespace App\Core\Providers;

use App\Models\Company;
use App\Models\User;
use App\Observers\CompanyObserver;
use App\Observers\UserObserver;
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
        User::observe(UserObserver::class);
    }
}
