<?php

return [
    // Specify custom middlewares
    'middlewares' => [
        'api' => [],
        'web' => []
    ],

    // Allow users to override model classes
    'models' => [
        'content' => \ClarityTech\Cms\Models\Content::class,
        'taxonomy' => \ClarityTech\Cms\Models\Taxonomy::class,
        'translation' => \ClarityTech\Cms\Models\Translation::class,
        'sound' => \ClarityTech\Cms\Models\Sound::class,
    ],

    // Enable/disable features
    'features' => [
        // 'filament_admin' => true,
        'api' => true,
    ],

    // Customize routes
    'routes' => [
        'api_prefix' => 'v1/',
    ],
];