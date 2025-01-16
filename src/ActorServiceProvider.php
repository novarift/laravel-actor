<?php

namespace Novarift\Actor;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ActorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-actor')
            ->hasConfigFile()
            ->hasMigrations([
                'create_actors_table',
            ]);
    }
}
