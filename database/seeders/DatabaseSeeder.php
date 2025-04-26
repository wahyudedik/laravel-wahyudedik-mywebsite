<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Dev',
            'email' => 'dev@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Run other seeders
        // $this->call([
        //     ProductSeeder::class,
        // ]);
    }
}
