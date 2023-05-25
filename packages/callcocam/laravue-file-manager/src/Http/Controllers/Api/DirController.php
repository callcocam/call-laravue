<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\FileManager\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SIGA\FileManager\Filters\FileManagerFilters;
use SIGA\FileManager\Http\Controllers\FileManagerController;
use SIGA\FileManager\Models\FileManager;
use SIGA\FileManager\Http\Requests\StoreFileManagerRequest;
use SIGA\FileManager\Http\Requests\UpdateFileManagerRequest;

class DirController extends FileManagerController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['dirs'] = FileManager::query()->orderBy('type')
            ->whereType('dir')
            ->whereNull('file_manager_id')
            ->with(['previews'])
            ->get();

        $data['filters'] =  FileManagerFilters::mappings();

        return response()->json($data);
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
    public function store(StoreFileManagerRequest $request)
    {
        $data = array_merge([
            'user_id' => auth()->user()->id,
            'tenant_id' => auth()->user()->tenant_id,
            'disk' => $this->getDriverFileManager(),
            'icon' => 'fa-folder',
            'type' => 'dir',
            'created_at' => now()->format("Y-m-d H:i:s"),
            'updated_at' => now()->format("Y-m-d H:i:s"),
        ], $request->input());

        if (!Storage::directoryExists($request->input('url'))) {
            Storage::createDirectory($request->input('url'));
            if (FileManager::query()->create($data)) {
                return response()->json([
                    'variant' => 'success',
                    'text' => trans('file-manager.success-folder-found', ['folder' => $request->input('name')]) //'A pasta não foi encontrada! (:folder)'
                ]);
            }
        }

        return  [
            'variant' => 'error',
            'text' => trans('file-manager.error-folder-not-found', ['folder' => $request->input('name')]) //'A pasta não foi encontrada! (:folder)'
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(FileManager $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FileManager $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileManagerRequest $request, FileManager $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $result = false;
        if ($dir = FileManager::withTrashed()->find($id)) {
            if ($request->query('trashed')) {
                $dir->files->map(function (FileManager $file) {
                    if (Storage::fileExists($file->url)) {
                        Storage::delete($file->url);
                    }
                    $file->forceDelete();
                });
                if (Storage::directoryExists($dir->path)) {
                    Storage::deleteDirectory($dir->path);
                }
                $result =  $dir->forceDelete();
                $message = trans('file-manager.success-folder-remove', ['folder' => $dir->path]);
            } elseif ($request->query('restore')) {
                $dir->files->map(function (FileManager $file) {
                    $file->restore();
                });
                $result =  $dir->restore();
                $message = trans('file-manager.success-folder-restore', ['folder' => $dir->path]);
            } else {
                $dir->files->map(function (FileManager $file) {
                    $file->delete();
                });
                $result =  $dir->delete();
                $message = trans('file-manager.success-folder-remove', ['folder' => $dir->path]);
            }
            if ($result) {
                return [
                    'variant' => 'success',
                    'text' => $message
                ];
            }
        }
        return  [
            'variant' => 'error',
            'text' => trans('file-manager.error-folder-not-found', ['folder' => " :("]) //'A pasta não foi encontrada! (:folder)'
        ];
    }
}
