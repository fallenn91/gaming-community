<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\EmailVerificationController;
use App\Livewire\Users\ProfileView;
use App\Livewire\Games\GameSearch;
use App\Livewire\Games\GameLibrary;
use App\Livewire\Communities\CommunityShow;
use App\Livewire\Communities\CommunityCreate;
use App\Livewire\ExplorePage;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile/{user}', ProfileView::class)->name('profile');
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/explore', ExplorePage::class)->name('explore');

    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::get('/community/{slug}', CommunityShow::class)->name('community.show');
    Route::get('/create', CommunityCreate::class)->name('community.create');

    Route::get('/games/{slug}', GameSearch::class);
    Route::get('/my-library', GameLibrary::class)->name('library');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{recipient}', [MessageController::class, 'show'])->name('messages.show');

    // routes/web.php — dentro del grupo auth
    Route::get('/games/search', [GameController::class, 'search'])->name('games.search');
    Route::get('/games/popular', [GameController::class, 'popular'])->name('games.popular');
    Route::get('/games/{igdbId}', [GameController::class, 'show'])->name('games.show');
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

Route::get('/email/verify', [EmailVerificationController::class, 'index'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

