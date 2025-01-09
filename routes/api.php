<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/articles/{articleID}/like', [ArticleController::class, 'incrementLike'])->name('api.articles.like');
Route::post('/articles/{articleID}/view', [ArticleController::class, 'incrementView'])->name('api.articles.view');
Route::post('/articles/{articleID}/comments', [CommentController::class, 'store'])->name('api.comments.store');
