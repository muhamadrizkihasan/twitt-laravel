<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TweetController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('tweets', TweetController::class)->except(['create'])->middleware('auth', 'verified');

Route::post('tweets/{tweet}/comments', [CommentController::class, 'store'])->middleware(['auth', 'verified'])->name('comments.store');
Route::get('tweets/{tweet}/comments/{comment}/edit', [CommentController::class, 'edit'])->middleware(['auth', 'verified'])->name('comments.edit');
Route::put('tweets/{tweet}/comments/{comment}', [CommentController::class, 'update'])->middleware(['auth', 'verified'])->name('comments.update');
Route::delete('tweets/{tweet}/comments/{comment}', [CommentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('comments.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
