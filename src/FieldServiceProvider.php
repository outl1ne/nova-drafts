<?php

namespace OptimistDigital\NovaDrafts;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use OptimistDigital\NovaDrafts\Commands\CreateDraftsMigration;

class FieldServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->translations();

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
        if ($this->app->routesAreCached()) return;

        Route::middleware(['api'])
            ->prefix('nova-vendor/nova-drafts')
            ->group(__DIR__ . '/../routes/api.php');
    }

    protected function translations()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../resources/lang' => resource_path('lang/vendor/nova-drafts')], 'translations');
        } else if (method_exists('Nova', 'translations')) {
            $locale = app()->getLocale();
            $fallbackLocale = config('app.fallback_locale');

            if ($this->attemptToLoadTranslations($locale, 'project')) return;
            if ($this->attemptToLoadTranslations($locale, 'local')) return;
            if ($this->attemptToLoadTranslations($fallbackLocale, 'project')) return;
            if ($this->attemptToLoadTranslations($fallbackLocale, 'local')) return;
            $this->attemptToLoadTranslations('en', 'local');
        }
    }

    protected function attemptToLoadTranslations($locale, $from)
    {
        $filePath = $from === 'local'
            ? __DIR__ . '/../resources/lang/' . $locale . '.json'
            : resource_path('lang/vendor/nova-drafts') . '/' . $locale . '.json';

        $localeFileExists = File::exists($filePath);
        if ($localeFileExists) {
            Nova::translations($filePath);
            return true;
        }
        return false;
    }
}
