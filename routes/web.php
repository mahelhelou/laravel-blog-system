<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/', function () { return view('home'); })->name('home');

// Authentication routes (simple session auth)
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User related routes
Route::resource('users', UserController::class);

// Article related routes

Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create')->middleware('auth');
Route::post('articles', [ArticleController::class, 'store'])->name('articles.store')->middleware('auth');
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit')->middleware(['auth','checkAuthor']);
Route::put('articles/{article}', [ArticleController::class, 'update'])->name('articles.update')->middleware(['auth','checkAuthor']);
Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy')->middleware(['auth','checkAuthor']);
