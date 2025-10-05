<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('home');
})->name('home');

// User related routes
// Route::get('/users', [UserController::class, 'index'])->middleware('auth');
// Route::get('/users/{id}/edit', [UserController::class, 'edit'])->middleware('auth');
// Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth');
Route::resource('users', UserController::class);



// Article related routes
// Route::get('/articles', [ArticleController::class, 'index']);
// Route::post('/articles', [ArticleController::class, 'insert'])->middleware('auth');
// Route::get('/articles/{id}', [ArticleController::class, 'show']);
// Route::put('/articles/{id}', [ArticleController::class, 'update'])->middleware('checkAuthor');
// Route::delete('/articles/{id}', [ArticleController::class, 'delete'])->middleware('checkAuthor');

Route::resource('articles', ArticleController::class);
