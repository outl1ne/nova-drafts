<?php

namespace OptimistDigital\NovaDrafts;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use OptimistDigital\NovaDrafts\Commands\CreateDraftsMigration;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-drafts', __DIR__.'/../dist/js/field.js');
        });

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateDraftsMigration::class,
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
