<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Menus\Providers;

use Illuminate\Support\ServiceProvider;
use SIGA\Console\Commands\APIControllerCommand;

class MenuServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(menu_path('resources/views'), 'siga');
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
            $this->loadMigrationsFrom(menu_path('/database/migrations'));
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
            menu_path('/database/migrations/') => database_path('migrations'),
            menu_path('/database/factories/') => database_path('factories'),
            menu_path('/database/seeders/') => database_path('seeders')
        ], 'siga-migrations');
    }

    private function publishViews(): void
    {
    }
}
