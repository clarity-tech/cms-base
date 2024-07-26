<?php

namespace ClarityTech\Cms;

use ClarityTech\Cms\Actions\CreateContent;
use ClarityTech\Cms\Actions\DeleteContent;
use ClarityTech\Cms\Actions\ListContent;
use ClarityTech\Cms\Actions\UpdateContent;
use ClarityTech\Cms\Contracts\CreatesContents;
use ClarityTech\Cms\Contracts\DeletesContents;
use ClarityTech\Cms\Contracts\ListsContents;
use ClarityTech\Cms\Contracts\UpdatesContents;
use Illuminate\Support\ServiceProvider;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        if(config('cms.features.api')) {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        }

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        // Filament::registerPlugin(new CmsPlugin());
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/cms.php', 'cms');

        app()->bind(CreatesContents::class, CreateContent::class);
        app()->bind(UpdatesContents::class, UpdateContent::class);
        app()->bind(DeletesContents::class, DeleteContent::class);
        app()->bind(ListsContents::class, ListContent::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['cms'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        $this->publishes([
            __DIR__.'/../config/cms.php' => config_path('cms.php'),
        ], 'cms.config');

        $publishesMigrationsMethod = method_exists($this, 'publishesMigrations')
            ? 'publishesMigrations'
            : 'publishes';

        $this->{$publishesMigrationsMethod}([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'cms.migrations');

        // Registering package commands.
        // $this->commands([]);
    }
}
