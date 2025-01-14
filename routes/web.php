<?php

use App\Core\Middleware\RedirectWithoutPermission;
use App\Http\BatchController;
use App\Http\BatchInfoController;
use App\Http\CollaboratorController;
use App\Http\CompanyController;
use App\Http\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::group(['prefix' => 'home', 'middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'collaborators'], function () {
        Route::get('/', [CollaboratorController::class, 'index'])->name('home.collaborators.index');
        Route::get('/create', [CollaboratorController::class, 'create'])->name('home.collaborators.create');
        Route::post('/store', [CollaboratorController::class, 'store'])->name('home.collaborators.store');
        Route::get('/edit/{id}', [CollaboratorController::class, 'edit'])->name('home.collaborators.edit');
        Route::put('/update/{id}', [CollaboratorController::class, 'update'])->name('home.collaborators.update');
        Route::put('/status/{id}', [CollaboratorController::class, 'status'])->middleware(RedirectWithoutPermission::class)->name('home.collaborators.status');
        Route::post('/batch', [CollaboratorController::class, 'batch'])->middleware(RedirectWithoutPermission::class)->name('home.collaborators.batch');
    });

    Route::group(['prefix' => 'batches', 'middleware' => RedirectWithoutPermission::class], function () {
        Route::get('/', [BatchController::class, 'index'])->name('home.batches.index');
    });

    Route::group(['prefix' => 'batch-infos', 'middleware' => RedirectWithoutPermission::class], function () {
        Route::get('/show/{id}', [BatchInfoController::class, 'show'])->name('home.batch_infos.show');
        Route::get('/obs/{id}', [BatchInfoController::class, 'obs'])->name('home.batch_infos.obs');
    });

    Route::group(['prefix' => 'companies', 'middleware' => RedirectWithoutPermission::class], function () {
        Route::get('/', [CompanyController::class, 'edit'])->name('home.companies.edit');
        Route::put('/update', [CompanyController::class, 'update'])->name('home.companies.update');
    });
});
