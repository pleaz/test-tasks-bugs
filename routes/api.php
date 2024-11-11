<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\IssueController;
use App\Http\Middleware\LogRequestMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => LogRequestMiddleware::class], function () {
    Route::apiResource('issues', IssueController::class)->names('issues');
    Route::apiResource('comments', CommentController::class)->names('comments')->only('update', 'destroy');

    Route::post('issues/{issue}/comments', [CommentController::class, 'store'])->name('issues.comments.store');
    Route::post('comments/{comment}/comments', [CommentController::class, 'storeReply'])->name('comments.comments.store');
});
