<?php

use App\Http\Controllers\LoginFaille\SecureLoginController;
use App\Http\Controllers\LoginFaille\StandardLoginController;
use App\Http\Controllers\LoginFaille\VulnerableLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->prefix('auth')->group(function () {
    Route::get('/standard', [StandardLoginController::class, 'showForm'])
        ->name('login.standard.form');

    Route::post('/standard', [StandardLoginController::class, 'login'])
        ->name('login.standard');

    Route::get('/secure', [SecureLoginController::class, 'showForm'])
        ->name('login.secure.form');

    Route::post('/secure', [SecureLoginController::class, 'login'])
        ->middleware('throttle:3,5')
        ->name('login.secure');

    if (app()->environment(['local', 'testing'])) {
        Route::get('/vulnerable', [VulnerableLoginController::class, 'showForm'])
            ->name('login.vulnerable.form');

        Route::post('/vulnerable', [VulnerableLoginController::class, 'login'])
            ->name('login.vulnerable');
    }
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', function (Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    })->name('logout');
});
