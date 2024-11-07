<?php

namespace ClarityTech\Cms;

use ClarityTech\Cms\Contracts\CreatesContents;
use ClarityTech\Cms\Contracts\DeletesContents;
use ClarityTech\Cms\Contracts\ListsContents;
use ClarityTech\Cms\Contracts\UpdatesContents;

class Cms
{
    public static $loadMigrations = true;
    
    /**
     * Get the name of the content model used by the application.
     *
     * @return string
     */
    public static function contentModel()
    {
        return config('cms.models.content');
    }

    // TODO: Get the name of other models similar way


    /**
     * Register a class / callback that should be used to create contents.
     *
     * @param  string  $class
     * @return void
     */
    public static function createContentsUsing(string $class) : void
    {
        app()->singleton(CreatesContents::class, $class);
    }

    /**
     * Register a class / callback that should be used to delete contents.
     *
     * @param  string  $class
     * @return void
     */
    public static function deleteContentUsing(string $class) : void
    {
        app()->singleton(DeletesContents::class, $class);
    }

    /**
     * Register a class / callback that should be used to list contents.
     *
     * @param  string  $class
     * @return void
     */
    public static function listContentUsing(string $class) : void
    {
        app()->singleton(ListsContents::class, $class);
    }

    /**
     * Register a class / callback that should be used to update contents.
     *
     * @param  string  $class
     * @return void
     */
    public static function updateContentUsing(string $class) : void
    {
        app()->singleton(UpdatesContents::class, $class);
    }
}
