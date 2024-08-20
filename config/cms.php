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
    ],

    'actions' => [
        'create_content' => \ClarityTech\Cms\Actions\CreateContent::class,
        'update_content' => \ClarityTech\Cms\Actions\UpdateContent::class,
        'delete_content' => \ClarityTech\Cms\Actions\DeleteContent::class,
        'list_content' => \ClarityTech\Cms\Actions\ListContent::class,
    ],

    // Enable/disable features
    'features' => [
        // 'filament_admin' => true,
        'api' => true,
    ],

    // Customize routes
    'routes' => [
        'api_prefix' => 'api/cms',
    ],
];