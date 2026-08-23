<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Created directly (not via User::factory()) since factories evaluate
        // fake() internally even for overridden fields, and fakerphp/faker is
        // a dev-only dependency unavailable in production (--no-dev).
        User::create([
            'name' => 'Krzysiek',
            'email' => 'eloquent160@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // change via /admin/password after first login
        ]);

        $this->call(ShopSeeder::class);
    }
}
