<?php

use ClarityTech\Cms\Http\Controllers\CommentController;
use ClarityTech\Cms\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;

Route::middleware(config('cms.middlewares.api'))
    ->prefix(config('cms.routes.api_prefix'))
    ->group(function () {
        // Content routes
        Route::get('contents', [ContentController::class, 'index']);
        Route::get('contents/{slug}', [ContentController::class, 'show']);

        // Comment routes
        Route::get('contents/{slug}/comments', [CommentController::class, 'index']);
        Route::post('contents/{slug}/comments', [CommentController::class, 'store']);
        Route::get('comments/{id}', [CommentController::class, 'show']);
        Route::put('comments/{id}', [CommentController::class, 'update']);
        Route::delete('comments/{id}', [CommentController::class, 'destroy']);
    });