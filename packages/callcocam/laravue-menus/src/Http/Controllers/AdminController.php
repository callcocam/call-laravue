<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Menus\Http\Controllers;

use SIGA\Http\Controllers\Controller;
use SIGA\Menus\Main\SidebarPanel;

class AdminController extends Controller
{

    /**
     * Requet index
     */
   
     public function loadtMenus()
     {
         return SidebarPanel::get();
     }
}
