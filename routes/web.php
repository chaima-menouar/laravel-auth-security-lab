<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginFaille\StandardLoginController;
use App\Http\Controllers\LoginFaille\SecureLoginController;
use App\Http\Controllers\LoginFaille\VulnerableLoginController;

Route::get('/', function () {
    return view('welcome');
});

// Groupe de routes pour les fonctionnalités de login
Route::prefix('auth')->group(function () {
    // Login Standard
    Route::get('/standard', [StandardLoginController::class, 'showForm'])
         ->name('login.standard.form');
    Route::post('/standard', [StandardLoginController::class, 'login'])
         ->name('login.standard');

    // Login Sécurisé
    Route::get('/secure', [SecureLoginController::class, 'showForm'])
         ->name('login.secure.form');
    Route::post('/secure', [SecureLoginController::class, 'login'])
         ->name('login.secure');

    // Login Vulnérable
    Route::get('/vulnerable', [VulnerableLoginController::class, 'showForm'])
         ->name('login.vulnerable.form');
    Route::post('/vulnerable', [VulnerableLoginController::class, 'login'])
         ->name('login.vulnerable');
});

// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});