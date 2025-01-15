<?php

use App\Http\CollaboratorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'collaborators'], function () {
    Route::get('/', [CollaboratorController::class, 'listAll'])->name('api.collaborators.all');
    Route::get('/{id}', [CollaboratorController::class, 'listOne'])->name('api.collaborators.one');
});
