<?php

/**
 * Created by Bengs.
 * User: contato@bengs.com.br
 * https://bengs.com.br
 */

namespace SIGA\Tenant;

use App\Models\Tenant as ModelsTenant;
use Illuminate\Support\ServiceProvider;
use SIGA\Models\Tenant;
use SIGA\Tenant\Facades\Tenant as FacadesTenant;

class TenantServiceProvider extends ServiceProvider
{

    protected $tenant;
    /**
     * Bootstrap the application eventos.
     *
     * @return void
     */
    public function boot()
    {
        if(!$this->app->runningInConsole()){
            $this->bootTenant();

            if (function_exists('config_path')) {
                $this->publishes([
                    realpath(__DIR__ . './../../config/landlord.php') => config_path('landlord.php'),
                ]);
            }
        }

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        if(class_exists('App\Models\Tenant')){
            $this->app->singleton(ITenant::class, 'App\Models\Tenant');
        }
        else{
                $this->app->singleton(ITenant::class, ModelsTenant::class);
        }

        $this->app->singleton(TenantManager::class, function () {
            return new TenantManager();
        });
    }

    public function bootTenant()
    {

        try {
            $this->tenant = Tenant::query()->where('domain', str_replace("admin.", "", request()->getHost()))->first();
            if (!$this->tenant) :
                die(response("Nenhuma empresa cadastrada com esse endereço " . str_replace("admin.", "", request()->getHost()), 401));

            endif;
            FacadesTenant::addTenant("tenant_id", data_get($this->tenant, 'id'));
            if ($this->tenant) {
                config([
                    'app.tenant_id' => $this->tenant->id,
                    'app.name' => $this->tenant->name,
                    'app.tenant' => $this->tenant->toArray(),
                ]);
            }
        } catch (\PDOException $th) {

            throw $th;
        }
    }
}
