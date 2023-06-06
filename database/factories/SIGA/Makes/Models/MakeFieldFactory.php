<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Database\Factories\SIGA\Makes\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use SIGA\Models\Tenant as ModelsTenant;
use SIGA\Makes\Models\MakeField;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MakeFields>
 */
class MakeFieldFactory extends Factory
{
    protected $model = MakeField::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tenant_id' => ModelsTenant::query()->first()->id,
            'ordering' => MakeField::query()->count(),
            //
        ];
    }
}
