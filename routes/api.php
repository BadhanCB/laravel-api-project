<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

Route::post('/signup', [UserAuthController::class, 'signup']);
Route::post('/login', [UserAuthController::class, 'login']);

Route::get('/articles', [ArticleController::class, 'getAllArticles']);
Route::get('/articles/{article}', [ArticleController::class, 'getArticle']);

Route::middleware('auth:sanctum')->group(function () {
  Route::post('/articles', [ArticleController::class, 'createArticle']);
  Route::put('/articles/{id}', [ArticleController::class, 'updateArticle']);
  Route::delete('/articles/{id}', [ArticleController::class, 'deleteArticle']);

  Route::resource('post', PostController::class);
});
