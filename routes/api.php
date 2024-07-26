<?php

use ClarityTech\Cms\Http\Controllers\ContentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(config('cms.middlewares.api'))
    ->prefix(config('cms.routes.api_prefix'))
    ->group(function () {
        Route::get('contents', [ContentController::class, 'index']);
        Route::get('contents/{content:slug}', [ContentController::class, 'show']);
    });