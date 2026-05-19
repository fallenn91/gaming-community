<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\EmailVerificationController;
use App\Livewire\Users\ProfileView;
use App\Livewire\Games\GameSearch;
use App\Livewire\Games\GameLibrary;
use App\Livewire\Communities\CommunityShow;
use App\Livewire\Communities\CommunityCreate;
use App\Livewire\ExplorePage;
use App\Models\Tag;

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'index'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
    Route::get('/email/verify-notification', [EmailVerificationController::class, 'resend'])->middleware('throttle:6,1')->name('verification.send');

    Route::get('/profile/{user}', ProfileView::class)->name('profile');
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/explore', ExplorePage::class)->name('explore');

    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::get('/community/{slug}', CommunityShow::class)->name('community.show');
    Route::get('/create', CommunityCreate::class)->name('community.create');

    Route::get('/games/{slug}', GameSearch::class);
    Route::get('/my-library', GameLibrary::class)->name('library');
});

Route::middleware('guest')->group(function () {
  Route::get('/', [LandingController::class, 'index'])->name('landing');
    Route::get('/login', [AuthController::class, 'index'])->name('auth');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

