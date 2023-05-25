<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Makes\Http\Controllers\Api;

use SIGA\Http\Controllers\Controller;
use SIGA\Makes\Models\Make;
use SIGA\Makes\Http\Requests\StoreMakeRequest;
use SIGA\Makes\Http\Requests\UpdateMakeRequest;
use SIGA\Makes\Resources\MakeResource;

class MakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Make::query()->paginate();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return MakeResource::make('Makes', 'makes')->icon('fa-layer-group');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMakeRequest $request)
    {

        return  Make::query()->create($request->input());
    }

    /**
     * Display the specified resource.
     */
    public function show(Make $make)
    {
        return  $make;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Make $make)
    {
        $data = MakeResource::make('Makes', 'makes')->icon('fa-layer-group');

        $data['data'] = $make;

        return  $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMakeRequest $request, Make $make)
    {
        return  $make->update($request->input());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Make $make)
    {
        //
    }
}
