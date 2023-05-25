<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Providers;

use Illuminate\Support\ServiceProvider;
use SIGA\Console\Commands\APIControllerCommand;

class SigaServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        if ($this->app->runningInConsole()) {

            $this->commands([
                APIControllerCommand::class
            ]);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(siga_path('resources/views'), 'siga');
        $this->publishMigrations();
        $this->loadMigrations();
        $this->publishViews();
    }
    /**
     * Load our migration files.
     *
     * @return void
     */
    protected function loadMigrations()
    {
        if (config('siga.migrate', true)) {
            $this->loadMigrationsFrom(siga_path('/database/migrations'));
        }
    }
    /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishes([
            siga_path('/database/migrations/') => database_path('migrations'),
            siga_path('/database/factories/') => database_path('factories'),
            siga_path('/database/seeders/') => database_path('seeders')
        ], 'siga-migrations');
    }

    private function publishViews(): void
    {
    }
}
