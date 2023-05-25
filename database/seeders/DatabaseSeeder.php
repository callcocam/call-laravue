<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TenantSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // $mail = sprintf("super-admin@%s", request()->getHost());
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => $mail
        // ]);

        // $this->call(TenantSeeder::class);
        // $this->call(FileManagerSeeder::class);
        // $this->call(PostSeeder::class);
        // $this->call(MenuSeeder::class);
        $this->call(SubMenuSeeder::class);
    }
}
