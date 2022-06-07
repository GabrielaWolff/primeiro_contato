<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleUserController;
use App\Http\Controllers\UserArticleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return "teste";
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users',[UserController::class,'store'])->name('users.store');
Route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::delete('/user/{id}', [UserController::class, 'delete'])->name('users.delete');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
Route::put('/article/{id}', [ArticleController::class, 'update'])->name('articles.update');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::delete('/article/{id}', [ArticleController::class, 'delete'])->name('articles.delete');

Route::get('/articleusers', [ArticleUserController::class, 'index'])->name('articleusers.index');

Route::get('/userarticles', [UserArticleController::class, 'index'])->name('userarticles.index');
Route::get('/userarticles/{id}', [UserArticleController::class, 'show'])->name('userarticles.show');
Route::post('/userarticles/{id}', [UserArticleController::class, 'store'])->name('userarticles.store');
Route::put('/userarticles/{id}/{articleId}', [UserArticleController::class, 'update'])->name('userarticles.update');
Route::delete('/userarticles/{id}/{articleId}', [UserArticleController::class, 'delete'])->name('userarticles.delete');



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
