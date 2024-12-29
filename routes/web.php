<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\MicropostsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('my_dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('users', UsersController::class)->only(['index', 'show']);
    Route::resource('microposts', MicropostsController::class)->only(['index', 'create', 'store', 'destroy', 'edit', 'update']);

    Route::post('/microposts/{micropost}/like', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/microposts/{micropost}/like', [LikeController::class, 'destroy'])->name('like.destroy');

    Route::post('/users/{user}/follow', [FollowController::class, 'store'])->name('follow.store');
    Route::delete('/users/{user}/unfollow', [FollowController::class, 'destroy'])->name('follow.destroy');
});

require __DIR__.'/auth.php';
