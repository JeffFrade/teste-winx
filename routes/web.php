<?php

use App\Http\CollaboratorController;
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
        Route::delete('/delete/{id}', [CollaboratorController::class, 'delete'])->name('home.collaborators.delete');
        Route::post('/batch', [CollaboratorController::class, 'batch'])->name('home.collaborators.batch');
    });
});
