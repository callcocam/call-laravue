<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Menus\Http\Controllers;

use SIGA\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    /**
     * Requet index
     */
    public function index(Request $request)
    {
        return  'menus';
    }
}
