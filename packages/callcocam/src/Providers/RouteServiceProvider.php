<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\Finder;
use Illuminate\Support\Str;
use ReflectionClass;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/admin';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(siga_route('api.php'));

            Route::middleware('web')
                ->group(siga_route('web.php'));

            if (is_dir(app_path("Http\\Controllers\\API"))) {
                Route::middleware('api')
                    ->prefix('api')
                    ->group(function () {
                        Route::middleware('auth:sanctum')->group(function () {
                            $path = app_path(Str::afterLast("Http\\Controllers\\Api", 'App\\'));
                            $path = Str::replace('/', DIRECTORY_SEPARATOR, $path);
                            $path = Str::replace('\\', DIRECTORY_SEPARATOR, $path);
                            $this->configureDynamicComponent($path);
                        });
                    });
            }
        });
    }

    /**
     * Configure the component for the application.
     *
     * @return void
     */
    public function configureDynamicComponent($path, $search = "app")
    {

        foreach ((new Finder())->in($path)->files()->name('*Controller.php') as $component) {
            $componentPath = $component->getRealPath();

            $namespace = Str::beforeLast($componentPath, '.php');
            $namespace = Str::afterLast($namespace, $search);
            $namespace = Str::replace(DIRECTORY_SEPARATOR, '\\', $namespace);
            $namespace = Str::of($namespace)->prepend("App")->toString();

            if (class_exists($namespace)) {
                $reflectionClass = new ReflectionClass($namespace);
                if ($reflectionClass->isInstantiable()) {
                    $path = Str::afterLast($namespace, "Api\\");
                    $path = Str::beforeLast($path, "Controller");
                    $path = Str::slug($path);
                    $path = Str::plural($path);
                    $comp = app($namespace);
                    if (method_exists($comp, 'route')) {
                        $comp->route($path);
                    }
                }
            }
        }
    }
}
