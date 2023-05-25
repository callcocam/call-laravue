<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Database\Factories\SIGA\Menus\Models;

use SIGA\Menus\Models\SubMenu;
use Illuminate\Database\Eloquent\Factories\Factory;
use SIGA\Models\Tenant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubMenu>
 */
class SubMenuFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubMenu::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tenant_id' => Tenant::query()->first()->id,
        ];
    }
}
