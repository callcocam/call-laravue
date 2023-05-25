<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Database\Factories\SIGA\FileManager\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SIGA\FileManager\Models\FileManager;
use SIGA\Models\Tenant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\SIGA\FileManager\Models\FileManager>
 */
class FileManagerFactory extends Factory
{

    protected $model = FileManager::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {


        return [
            'tenant_id' => Tenant::query()->first()->id,
            'user_id' => User::query()->first()->id,
            'disk' => 'public',
            'icon' => 'fa-regular-images',
            'type' => 'file',
            'created_at' => now()->format("Y-m-d H:i:s"),
            'updated_at' => now()->format("Y-m-d H:i:s"),
            //
        ];
    }
}
