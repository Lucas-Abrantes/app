<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Rotas de autenticação
Route::middleware('guest')->group(function () {
    Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',  [AuthController::class, 'login']);
});

// Todas as rotas abaixo exigem login
Route::middleware('auth')->group(function () {
    // Dashboard (listagem de contatos)
    Route::get('/', [ContactController::class, 'index'])
         ->name('dashboard');
    Route::resource('contacts', ContactController::class);
    Route::post('/logout', [AuthController::class, 'logout'])
         ->name('logout');
});
