<?php

use App\Core\Middleware\RedirectWithoutPermission;
use App\Http\BatchController;
use App\Http\BatchInfoController;
use App\Http\CollaboratorController;
use App\Http\CompanyController;
use App\Http\HomeController;
use App\Http\UserController;
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

    Route::group(['prefix' => 'users'], function () {
        Route::group(['middleware' => RedirectWithoutPermission::class], function () {
            Route::get('/', [UserController::class, 'index'])->name('home.users.index');
            Route::get('/create', [UserController::class, 'create'])->name('home.users.create');
            Route::post('/store', [UserController::class, 'store'])->name('home.users.store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('home.users.edit');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('home.users.update');
            Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('home.users.delete');
        });
        
        Route::get('/profile', [UserController::class, 'profile'])->name('home.users.profile');
    });
});
