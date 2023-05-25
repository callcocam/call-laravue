<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace SIGA\Menus\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use SIGA\Menus\Models\SubMenu;
use SIGA\Menus\Http\Requests\StoreSubMenuRequest;
use SIGA\Menus\Http\Requests\UpdateSubMenuRequest;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubMenuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SubMenu $subMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubMenu $subMenu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubMenuRequest $request, SubMenu $subMenu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubMenu $subMenu)
    {
        //
    }
}
