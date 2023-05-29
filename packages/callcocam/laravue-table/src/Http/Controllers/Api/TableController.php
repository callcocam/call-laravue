<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace SIGA\Table\Http\Controllers\Api;

use SIGA\Http\Controllers\Controller;
use SIGA\Table\Models\Tableconfig;
use SIGA\Table\Http\Requests\StoreTableconfigRequest;
use SIGA\Table\Http\Requests\UpdateTableconfigRequest;

class TableController extends Controller
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
    public function store(StoreTableconfigRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tableconfig $tableconfig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tableconfig $tableconfig)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTableconfigRequest $request, Tableconfig $tableconfig)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tableconfig $tableconfig)
    {
        //
    }
}
