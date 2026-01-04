<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');
});

Route::get('categories', [CategoryController::class, 'index']);
Route::get('stats', [TopicController::class, 'stats']);

Route::apiResource('topics', TopicController::class)->except(['store', 'update', 'destroy']);
Route::get('topics/{uuid}/comments', [\App\Http\Controllers\CommentController::class, 'index']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('topics', [TopicController::class, 'store']);
    Route::put('topics/{uuid}', [TopicController::class, 'update']);
    Route::delete('topics/{uuid}', [TopicController::class, 'destroy']);
    Route::post('topics/{uuid}/comments', [\App\Http\Controllers\CommentController::class, 'store']);
    Route::get('test-auth', function () {
        return response()->json(auth('api')->user());
    });
});

Route::get('users', [UserController::class, 'index']);
Route::get('users/{username}', [UserController::class, 'show']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::put('profile', [UserController::class, 'update']);
    Route::post('profile/avatar', [UserController::class, 'uploadAvatar']);
});
