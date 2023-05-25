<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\FileManager\Http\Controllers\Api;

use Illuminate\Http\Request;
use SIGA\FileManager\Filters\FileManagerFilters;
use SIGA\FileManager\Http\Controllers\FileManagerController;
use SIGA\FileManager\Models\FileManager;

class FilterController extends FileManagerController
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return FileManagerFilters::mappings();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($model = FileManager::findOrFail($request->input('id'))) {
            return [
                'file' => $model->update($request->input()),
                'variant' => 'success',
                'text' => trans('file-manager.success-file-updated')
            ];
        }
        return  [];
    }
}
