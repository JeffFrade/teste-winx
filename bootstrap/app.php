<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

$namespace = 'App\\Http';

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () use ($namespace) {
            Route::middleware('web')
                ->namespace($namespace)
                ->group(base_path('routes/web.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
