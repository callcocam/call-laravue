<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Database\Factories\SIGA\Table\Models;
 
use Illuminate\Database\Eloquent\Factories\Factory;
use SIGA\Models\Tenant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TableConfig>
 */
class TableConfigFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
              'tenant_id' => Tenant::query()->first()->id,
            //
        ];
    }
}