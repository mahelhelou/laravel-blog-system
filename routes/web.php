<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/articles', [ArticleController::class, 'index']);
Route::post('/articles', [ArticleController::class, 'insert'])->middleware('auth');
Route::get('/articles/{id}', [ArticleController::class, 'show']);
Route::put('/articles/{id}', [ArticleController::class, 'update'])->middleware('checkAuthor');
Route::delete('/articles/{id}', [ArticleController::class, 'delete'])->middleware('checkAuthor');
