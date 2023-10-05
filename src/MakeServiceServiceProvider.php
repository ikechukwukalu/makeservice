<?php

namespace Ikechukwukalu\Makeservice;

use Illuminate\Support\ServiceProvider;
use Ikechukwukalu\Makeservice\Console\Commands\MakeActionCommand;
use Ikechukwukalu\Makeservice\Console\Commands\MakeEnumCommand;
use Ikechukwukalu\Makeservice\Console\Commands\MakeFacadeCommand;
use Ikechukwukalu\Makeservice\Console\Commands\MakeInterfaceCommand;
use Ikechukwukalu\Makeservice\Console\Commands\MakeRepositoryCommand;
use Ikechukwukalu\Makeservice\Console\Commands\MakeServiceCommand;
use Ikechukwukalu\Makeservice\Console\Commands\MakeTraitCommand;

class MakeServiceServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeActionCommand::class,
                MakeEnumCommand::class,
                MakeFacadeCommand::class,
                MakeInterfaceCommand::class,
                MakeRepositoryCommand::class,
                MakeServiceCommand::class,
                MakeTraitCommand::class
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
