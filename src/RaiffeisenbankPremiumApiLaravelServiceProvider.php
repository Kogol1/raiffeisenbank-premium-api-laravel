<?php

namespace Kogol1\RaiffeisenbankPremiumApiLaravel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Kogol1\RaiffeisenbankPremiumApiLaravel\Commands\RaiffeisenbankPremiumApiLaravelCommand;

class RaiffeisenbankPremiumApiLaravelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('raiffeisenbank-premium-api-laravel')
            ->hasConfigFile()
            ->hasCommand(RaiffeisenbankPremiumApiLaravelCommand::class);
    }
}
