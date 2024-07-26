<?php

return [
    // Specify custom middlewares
    'middlewares' => [
        'api' => [],
        'web' => []
    ],

    // Customize database table names
    'table_names' => [
        'contents' => 'contents',
        'taxonomies' => 'taxonomies',
        'translations' => 'translations',
        'sounds' => 'sounds',
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