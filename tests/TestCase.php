<?php

namespace ClarityTech\Cms\Tests;

use ClarityTech\Cms\CmsServiceProvider;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use WithWorkbench;

    protected function setUp(): void
    {
        parent::setUp();

        // Uncommenting this part make all factroy of the package work, but not UserFactory
        // Factory::guessFactoryNamesUsing(
        //     fn (string $modelName) => 'ClarityTech\\Cms\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        // );
    }

    protected function getPackageProviders($app)
    {
        return [
            CmsServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // 
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}