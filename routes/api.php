<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Models\ActivityLog;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')
    ->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1/')->middleware(['auth:sanctum','throttle:60,1:ip'])->group(function () {
    Route::apiResource('posts', PostController::class, [
        'except' => ['index', 'show'],
    ]);
});

Route::get('/v1/posts', [PostController::class, 'index']);
Route::get('/v1/articles/{id}', [PostController::class, 'show']);

Route::get('/activity-logs', function () {
    return ActivityLog::get();
});
