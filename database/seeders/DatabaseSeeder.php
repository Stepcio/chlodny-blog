<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default local dev password is "password" (Laravel's UserFactory default) — change it via /admin/password.
        User::factory()->create([
            'name' => 'Chris',
            'email' => 'eloquent160@gmail.com',
        ]);

        $this->call(ShopSeeder::class);
    }
}
