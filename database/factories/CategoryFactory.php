<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use SIGA\Models\Tenant as ModelsTenant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tenant_id' => ModelsTenant::query()->first()->id,
            'user_id' => User::all()->random()->id,
            'name' => $this->faker->name, 
            'created_at' => now()->format("Y-m-d H:i:s"),
            'updated_at' => now()->format("Y-m-d H:i:s"),
        ];
    }
}