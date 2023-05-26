<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Menus\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use SIGA\Models\AbstractModel;

class SubMenu extends AbstractModel
{
    use HasFactory; 

    public function menus()
    {
        return $this->belongsToMany(Menu::class)->withTimestamps();
    }


    public function sub_menus_items()
    {
        return $this->belongsToMany(SubMenu::class, null, 'children_id',  'parent_id')->withTimestamps();
    }


    public function items_sub_menus()
    {
        return $this->belongsToMany(SubMenu::class, null,  'parent_id', 'children_id')->withTimestamps();
    }
}
