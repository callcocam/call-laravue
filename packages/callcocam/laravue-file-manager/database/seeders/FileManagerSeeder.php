<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SIGA\FileManager\Models\FileManager;
use SIGA\Models\Tenant;
use Symfony\Component\HttpFoundation\File\File;

class FileManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Storage::deleteDirectory('file_managers');
        FileManager::query()->forceDelete();

        foreach (['posts', 'eventos', 'produtos', 'videos'] as $dir) {

            $this->createFolder(sprintf("file_managers/%s", $dir), []);
        }
        foreach (FileManager::all() as $file_manager) {
            for ($i = 0; $i <= rand(1, 4); $i++) {
                $this->createFolder(sprintf("%s/%s", $file_manager->path, str_pad($i, 2, '0', STR_PAD_LEFT)), [
                    'file_manager_id' => $file_manager->id
                ]);
            }
        }

        $ids = FileManager::query()->whereType('dir')->pluck('id')->toArray();
        foreach ((new \Symfony\Component\Finder\Finder)->in(storage_path('app/public/samples'))->files() as $file) {
            if (isset($ids[rand(0,  count($ids) - 1)])) {
                $model = FileManager::query()->whereId($ids[rand(0, count($ids) - 1)])->first();
                if ($model) {
                    $path = $model->path;
                    $name = Str::ulid();
                    $image = sprintf("%s/%s.%s", $path, $name, $file->getExtension());
                    $location = Str::afterLast($file->getRealPath(), '\\public');
                    Storage::copy($location, $image);
                    $url = $image;
                    FileManager::factory(2)->create(
                        [
                            'file_manager_id' => $model->id,
                            'url' => $url,
                            'name' => $name,
                            'extension' => $file->getExtension(),
                            'path' => $path,
                            'size' => $file->getSize(),
                            'mime_type' => Storage::mimeType($url),
                            'shared' => rand(0, 1),
                            'recent' => rand(0, 1) ? now()->format("Y-m-d H:i:s") : null,
                            'important' => rand(0, 1),
                        ]
                    );
                }
            }
        }
    }

    public function createFolder($dir, $data)
    {
        if (!Storage::directoryExists($dir)) {
            Storage::createDirectory($dir);
        }
        $path = $dir;
        $url = $path;
        $name = Str::afterLast($dir, '/');
        $name = Str::title($name);
        return FileManager::query()->create(
            array_merge([
                'tenant_id' => Tenant::query()->first()->id,
                'user_id' => User::query()->first()->id,
                'url' => $url,
                'disk' => 'public',
                'name' =>  $name,
                'extension' => null,
                'path' => $path,
                'size' => rand(),
                'icon' => 'fa-folder',
                'mime_type' => null,
                'created_at' => now()->format("Y-m-d H:i:s"),
                'updated_at' => now()->format("Y-m-d H:i:s"),
                //
            ], $data)
        );
    }
}
