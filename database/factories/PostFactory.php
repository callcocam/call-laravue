<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use SIGA\FileManager\Models\FileManager;
use SIGA\Models\Tenant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $content = implode(', ', $this->faker->sentences);
        return [
            'tenant_id' => Tenant::query()->first()->id,
            'user_id' => User::all()->random()->id,
            'file_manager_id' => FileManager::query()->whereType('file')->get()->random()->id,
            'name' => $this->faker->sentence,
            'content' => $content,
            'created_at' => now()->format("Y-m-d H:i:s"),
            'updated_at' => now()->format("Y-m-d H:i:s"),
        ];
    }
}
