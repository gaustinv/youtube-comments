<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/videos/{id}/comments', [CommentController::class, 'store']);
    Route::get('/videos/{id}/top-comments', [CommentController::class, 'topComments']);
    Route::post('/comments/{id}/like', [CommentLikeController::class, 'like']);
    Route::post('/comments/{id}/dislike', [CommentLikeController::class, 'dislike']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
