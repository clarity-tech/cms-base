<?php

use ClarityTech\Cms\Http\Controllers\ContentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')
    ->prefix('v1/')
    ->group(function () {
        Route::get('contents', [ContentController::class, 'index']);
        Route::get('contents/{content:slug}', [ContentController::class, 'show']);
    });