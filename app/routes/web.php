<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Livewire\Users\ProfileView;
use App\Models\Tag;

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile/{user}', ProfileView::class)->name('profile');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('auth');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/landing', function () {
      return view('landing');
    })->name('landing');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

