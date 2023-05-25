<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Makes\Providers;

use Illuminate\Support\ServiceProvider;

class MakeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        if ($this->app->runningInConsole()) {

            // $this->commands([
            //     APIControllerCommand::class
            // ]);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(make_path('resources/views'), 'siga');
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
            $this->loadMigrationsFrom(make_path('/database/migrations'));
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
            make_path('/database/migrations/') => database_path('migrations'),
            make_path('/database/factories/') => database_path('factories'),
            make_path('/database/seeders/') => database_path('seeders')
        ], 'siga-migrations');
    }

    private function publishViews(): void
    {
    }
}
