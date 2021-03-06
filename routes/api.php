<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostController::class , 'index']);
Route::get('/last-posts', [PostController::class , 'lastPost']);
Route::get('/search-posts/{id}', [PostController::class , 'serchPosts']);
Route::get('/categories', [PostController::class , 'categories']);


Route::get('/post/{id}', [PostController::class , 'show']);
Route::post('/add-comment', [PostController::class , 'addComment']);
Route::post('/add-like', [PostController::class , 'addLike']);
Route::post('/add-dislike', [PostController::class , 'disLike']);
Route::post('/add-post', [PostController::class , 'store']);
Route::post('/categories', [PostController::class , 'getCategories']);
Route::get('/users', [PostController::class , 'getUsers']);
Route::post('/deleteUser', [PostController::class , 'destroyUser']);
Route::post('/delete-commit', [PostController::class , 'destroyCommit']);
Route::post('/delete-post', [PostController::class , 'destroyPost']);