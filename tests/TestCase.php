<?php

namespace Kogol1\RaiffeisenbankPremiumApiLaravel\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Kogol1\RaiffeisenbankPremiumApiLaravel\RaiffeisenbankPremiumApiLaravelServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Kogol1\\RaiffeisenbankPremiumApiLaravel\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            RaiffeisenbankPremiumApiLaravelServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_raiffeisenbank-premium-api-laravel_table.php.stub';
        $migration->up();
        */
    }
}
