<?php

namespace Kogol1\RaiffeisenbankPremiumApiLaravel;

use Kogol1\RaiffeisenbankPremiumApiLaravel\Commands\RaiffeisenbankPremiumApiLaravelCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
