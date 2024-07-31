<?php

use ClarityTech\Cms\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;

Route::middleware(config('cms.middlewares.api'))
    ->prefix(config('cms.routes.api_prefix'))
    ->group(function () {
        Route::get('contents', [ContentController::class, 'index']);
        Route::get('contents/{slug}', [ContentController::class, 'show']);
    });