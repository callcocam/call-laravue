<?php

namespace Database\Seeders;

use SIGA\Menus\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Menu::factory()->create([
            'name'=>"Menus Admin",
            'order'=>'1',
            'description'=>'Agrupa os menus para o admin'
       ]);
    }
}
