<?php

namespace OptimistDigital\NovaDrafts;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use OptimistDigital\NovaDrafts\Commands\CreateDraftsMigration;
use OptimistDigital\NovaDrafts\Http\Middleware\Authorize;

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
            Nova::script('nova-drafts', __DIR__ . '/../dist/js/field.js');
        });

        $this->app->booted(function () {
            $this->routes();
        });

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateDraftsMigration::class,
            ]);
        }
    }

    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }
        Route::middleware(['nova', Authorize::class])
            ->prefix('nova-vendor/nova-drafts')
            ->group(__DIR__ . '/../routes/api.php');
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
