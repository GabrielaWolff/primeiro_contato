<?php

use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\CommentController;
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
    return "teste ok";
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
Route::get('/userarticles/{id}/{articleId}', [UserArticleController::class, 'show'])->name('userarticles.show');
Route::post('/userarticles/{id}', [UserArticleController::class, 'store'])->name('userarticles.store');
Route::put('/userarticles/{id}/{articleId}', [UserArticleController::class, 'update'])->name('userarticles.update');
Route::delete('/userarticles/{id}/{articleId}', [UserArticleController::class, 'delete'])->name('userarticles.delete');

Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store'); //escreve no banco
Route::put('/comment/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::get('/comment/{id}', [CommentController::class, 'show'])->name('comments.show');
Route::delete('/comment/{id}', [CommentController::class, 'delete'])->name('comments.delete');

Route::get('/articlecomments', [ArticleCommentController::class, 'index'])->name('articlecomments.index');
Route::get('/articlecomments/{id}/{commentId}', [ArticleCommentController::class, 'show'])->name('articlecomments.show');
Route::post('/articlecomments/{id}', [ArticleCommentController::class, 'store'])->name('articlecomments.store');
Route::put('/articlecomments/{id}/{commentId}', [ArticleCommentController::class, 'update'])->name('articlecomments.update');
Route::delete('/articlecomments/{id}/{commentId}', [ArticleCommentController::class, 'delete'])->name('articlecomments.delete');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
