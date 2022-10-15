<?php

namespace Daaner\NovaPoshta;

use Illuminate\Support\ServiceProvider;

class NovaPoshtaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/novaposhta.php' => config_path('novaposhta.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/lang' => $this->app['path.lang'].'/vendor/novaposhta',
        ]);

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'novaposhta');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/novaposhta.php', 'novaposhta');

        $this->app->singleton('novaposhta', function () {
            return $this->app->make(NovaPoshta::class);
        });

        $this->app->alias('novaposhta', 'NovaPoshta');
    }
}
