<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Http\Controllers;

use App\Http\Controllers\Controller; 

class AdminController extends Controller
{

    public function index()
    {
        return view('siga::layouts.app');
    }
 
}
