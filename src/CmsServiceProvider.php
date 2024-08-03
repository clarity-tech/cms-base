<?php

namespace ClarityTech\Cms;

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
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        
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

        // Register the service the package provides.
        $this->app->singleton('cms', function ($app) {
            return new Cms;
        });

        Cms::createContentsUsing(config('cms.actions.create_content'));
        Cms::updateContentUsing(config('cms.actions.update_content'));
        Cms::deleteContentUsing(config('cms.actions.delete_content'));
        Cms::listContentUsing(config('cms.actions.list_content'));
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
