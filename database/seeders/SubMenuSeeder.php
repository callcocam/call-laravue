<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Database\Seeders;

use SIGA\Menus\Models\Menu;
use SIGA\Menus\Models\SubMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::query()->first();
        SubMenu::query()->forceDelete();
        $operaciona = SubMenu::factory()->create([
            'name' => "Operacional",
            'route' => 'operacional',
            'icon' => 'fa-cogs',
            'component' => 'NavGroup',
            'order' => '1',
            'description' => 'Agrupa os sub menus operacional'
        ]);
        $operaciona->menus()->sync([$menu->id]);

        $sub = SubMenu::factory()->create([
            'name' => "Menus",
            'route' => 'menus',
            'icon' => 'fa-bars',
            'component' => 'NavItem',
            'order' => '1',
            'description' => 'Agrupa os menus para o admin'
        ]);
        $sub->menus()->sync([$menu->id]);
        $operacionaSub[] = $sub->id;

        $sub = SubMenu::factory()->create([
            'name' => "Sub Menus",
            'route' => 'submenus',
            'icon' => 'fa-th-list',
            'component' => 'NavItem',
            'order' => '2',
            'description' => 'Sub menus para o sistema admin e site'
        ]);
        $sub->menus()->sync([$menu->id]);
        $operacionaSub[] = $sub->id;

        $sub = SubMenu::factory()->create([
            'name' => "Users",
            'route' => 'users',
            'icon' => 'fa-users',
            'component' => 'NavItem',
            'order' => '3',
            'description' => 'Usuários do sistema'
        ]);
        $sub->menus()->sync([$menu->id]);
        $operacionaSub[] = $sub->id;

        $sub = SubMenu::factory()->create([
            'name' => "Roles",
            'route' => 'roles',
            'icon' => 'fa-lock',
            'component' => 'NavItem',
            'order' => '4',
            'description' => 'Papéis do sistema'
        ]);
        $sub->menus()->sync([$menu->id]);
        $operacionaSub[] = $sub->id;


        $sub = SubMenu::factory()->create([
            'name' => "Permissions",
            'route' => 'permissions',
            'icon' => 'fa-lock-open',
            'component' => 'NavItem',
            'order' => '5',
            'description' => 'Permissões do sistemas'
        ]);
        $sub->menus()->sync([$menu->id]);
        $operacionaSub[] = $sub->id;


        $sub = SubMenu::factory()->create([
            'name' => "Campaigns",
            'route' => 'campaigns',
            'icon' => 'fa-houzz',
            'component' => 'NavItem',
            'order' => '6',
            'description' => 'Cadastrar campanhas'
        ]);
        $sub->menus()->sync([$menu->id]);
        $operacionaSub[] = $sub->id;
        $operaciona->sub_menus_items()->sync($operacionaSub);
    }
}
