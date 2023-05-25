<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace  SIGA\Database\Seeders;

use SIGA\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $clone = config('database.connections.mysql');
        // $clone['database'] = 'landlord';
        // Config::set("database.connections.landlord", $clone);
        // Config::set("database.default", 'landlord');

        $host = \Illuminate\Support\Str::replace("www.", '', request()->getHost());

        $connection = config("tenant.landlord_database_connection_name", "mysql");
        /**
         *@var $tenantModel Builder
         */
        $tenantModel = app(config("tenant.tenant_model", Tenant::class));

        DB::connection($connection)->table('tenants')->delete();

        $id =  \Ramsey\Uuid\Uuid::uuid4();

        $tenant = $tenantModel->factory()->create([
            'id' => $id,
            'name' => "Sistema Integrado De Gerenciamento E Administração",
            'slug' => "sistema-integrado-de-gerenciamento-e-administracao",
            'domain' => $host,
            'email' => "contato@sigasmart.com.br",
            'description' => 'Sistema Integrado De Gerenciamento E Administração',
            'database' => $connection,
            'prefix' => 'admin',
            'middleware' => $connection,
            'provider' => $connection,
        ]);
        // DB::connection($connection)->table('tenants')->insert($tenant);
    }
}
