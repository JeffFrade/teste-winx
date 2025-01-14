<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::group(['prefix' => 'home', 'middleware' => 'auth'], function () {
    Route::get('/', [App\Http\HomeController::class, 'index'])->name('home');
});
