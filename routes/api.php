<?php

use App\Http\Controllers\ArticleController;
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
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::delete('/articles/{id}', [ArticleController::class, 'delete'])->name('articles.delete');




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
