<?php

namespace Ikechukwukalu\Makeservice;

use Illuminate\Support\ServiceProvider;
use Ikechukwukalu\Makeservice\Console\Commands\MakeServiceCommand;

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
                MakeServiceCommand::class
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
