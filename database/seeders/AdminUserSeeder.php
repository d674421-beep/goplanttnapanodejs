<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('admin.email');
        $password = config('admin.password');
        $name = config('admin.name');

        if (!$email || !$password) {
            $this->command->warn('ADMIN_EMAIL atau ADMIN_PASSWORD belum diset di file .env');
            return;
        }

        // Cek apakah user sudah ada
        $existingUser = User::where('email', $email)->first();

        if (!$existingUser) {
            // INSERT pertama kali → wajib ada password
            User::create([
                'name'                 => $name,
                'email'                => $email,
                'password'             => Hash::make($password),
                'is_admin'             => true,
                'email_verified_at'    => now(),
                'email_otp_expires_at' => null,
            ]);

            $this->command->info('Admin user berhasil dibuat.');
            return;
        }

        // Jika sudah ada → update data non-password
        $existingUser->update([
            'name'                 => $name,
            'is_admin'             => true,
            'email_verified_at'    => now(),
            'email_otp_expires_at' => null,
        ]);

        // Update password hanya jika beda
        if (!Hash::check($password, $existingUser->password)) {
            $existingUser->update([
                'password' => Hash::make($password),
            ]);
            $this->command->info('Password admin diperbarui.');
        }

        $this->command->info('Admin user diperbarui.');
    }
}
