<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;



Route::get('/posts', [PublicController::class, 'index']);
Route::get('/posts/{post}', [PublicController::class, 'post']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/tags', [TagController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::post('/post/{post}/comment', [PublicController::class, 'comment']);
    Route::post('/post/{post}/like', [PublicController::class, 'like']);
    Route::apiResource('/admin/posts', PostController::class);
    Route::apiResource('/admin/tags', TagController::class);
});
