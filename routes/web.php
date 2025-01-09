<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticleController::class, 'main'])->name('home');
Route::get('/articles', [ArticleController::class, 'catalog'])->name('articles.catalog');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
