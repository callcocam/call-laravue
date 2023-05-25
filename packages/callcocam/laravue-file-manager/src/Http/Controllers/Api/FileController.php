<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\FileManager\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SIGA\FileManager\Http\Controllers\FileManagerController;
use SIGA\FileManager\Models\FileManager;
use SIGA\FileManager\Http\Requests\StoreFileManagerRequest;
use SIGA\FileManager\Http\Requests\UpdateFileManagerRequest;

class FileController extends FileManagerController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->getFiles($request);
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

        if ($model = $this->uploadFiles($request)) {
            return [
                'file' => $model->toArray(),
                'variant' => 'success',
                'text' => trans('file-manager.success-file-upload')
            ];
        }
        return  [
            'file' => null,
            'variant' => 'error',
            'text' => trans('file-manager.error-file-upload')
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(FileManager $file)
    {
        $data = array_merge($file->toArray(), ['folder'=>FileManager::find($file->file_manager_id)]);
        
        return  response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, FileManager $file)
    {
        return  response()->json($file);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileManagerRequest $request, FileManager $file)
    {
        if ($file->name == $request->input('name')) {
            $data = $request->input();
        } else {
            $slug = Str::slug($request->input('name'));
            $url = Str::replace($file->name,  $slug, $file->url);
            Storage::copy($file->url, $url);
            Storage::delete($file->url);
            $data = array_merge($request->input(), [
                'name' => $slug,
                'url' => $url,
            ]);
        }
        if ($file->update($data)) {
            return response()->json([
                'variant' => 'success',
                'text' => trans('file-manager.success-file-updated')
            ]);
        }
        return  response()->json([
            'variant' => 'error',
            'text' => trans('file-manager.error-file-updated')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param FileManager $file
     * @return array
     */
    public function destroy(Request $request, $id)
    {
        $result = false;
        if ($file = FileManager::withTrashed()->find($id)) {
            if ($request->query('trashed')) {
                if (Storage::fileExists($file->url)) {
                    Storage::delete($file->path);
                }
                $result =  $file->forceDelete();
                $message = trans('file-manager.success-file-restore');
            } elseif ($request->query('restore')) {
                $result =  $file->restore();
                $message = trans('file-manager.success-file-restore');
            } else {
                $result =  $file->delete();
                $message = trans('file-manager.success-file-removed');
            }
            if ($result) {
                return [
                    'variant' => 'success',
                    'files' => $this->getFiles($request),
                    'text' => $message
                ];
            }
        }
        return  [
            'variant' => 'error',
            'text' => trans('file-manager.error-file-removed')
        ];
    }

    protected function getFiles(Request $request)
    {
        return FileManager::query()->orderByDesc('recent')
            ->when($request->query('file_manager_id'), function ($query, $val) {
                $query->where('file_manager_id', $val);
            })->filter($request)->paginate($request->query('per_page', 12));
    }

    /**
     * @param Request $request
     * @param string $path
     * @return mixed
     */
    protected function uploadFiles(Request $request)
    {
        $path = $request->input('path', '');
        $model = null;
        $data = [];
        $data['file_manager_id'] = $request->input('file_manager_id', null);
        $data['path'] = $path;
        if ($allFiles = $request->allFiles()) {
            foreach ($allFiles as $name => $files) {
                $model = FileManager::query()->create(array_merge($this->fileUpload($files, $path), $data));
            }
        }

        return $model;
    }

    /**
     * @param UploadedFile $file
     * @param $path
     * @return array
     */
    protected  function fileUpload(UploadedFile $file, $path)
    {

        $storage_disk = $this->getDriverFileManager() ?? config('filesystems.default');
        $name = sprintf("%s-%s", now()->format('YmdHis'), $file->getClientOriginalName());
        $mime_type = $file->getMimeType();
        $extension = Str::afterLast($file->getClientOriginalName(), '.');
        $filename = $file->storeAs($path, $name, $storage_disk);
        $data =
            [
                'user_id' => auth()->user()->id,
                'tenant_id' => auth()->user()->tenant_id,
                'url' => $filename,
                'disk' => $storage_disk,
                'name' => $name,
                'extension' => $extension,
                'path' => $path,
                'size' => $file->getSize(),
                'icon' => $this->getFileIcon($extension),
                'mime_type' => $mime_type,
                'type' => 'file',
                'created_at' => now()->format("Y-m-d H:i:s"),
                'updated_at' => now()->format("Y-m-d H:i:s"),
            ];

        return $data;
    }



    protected function getFileIcon($type)
    {

        if (in_array($type, ['png', 'jpg', 'jfif', 'gif', 'jpeg'])) return 'fa-file-image';
        if (in_array($type, ['pdf'])) return 'fa-file';
        if (in_array($type, ['mp4'])) return 'fa-video';
        if (in_array($type, ['mp3'])) return 'fa-file-audio';

        return 'fa-folder';
    }
}
