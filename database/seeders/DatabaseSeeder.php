<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1️⃣ Admin (WAJIB ADA)
        $this->call([
            AdminUserSeeder::class,
        ]);

        // 2️⃣ User dummy (OPSIONAL - hanya local/testing)
        if (app()->environment('local')) {
            \App\Models\User::factory(5)->create();
        }
    }
}
