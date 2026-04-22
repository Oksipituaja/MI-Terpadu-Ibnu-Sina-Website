<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. LIMIT KEAMANAN (Mencegah database membengkak lebih dari 100)
        $limitTotal = 100;
        if (User::count() >= $limitTotal) {
            $this->command->warn("Database sudah mencapai limit {$limitTotal} akun. Seeder dilewati.");
            return;
        }

        // 2. AKUN UTAMA (3 Akun)
        $mainUsers = [
            ['name' => 'Super Administrator', 'email' => 'superadmin@school.com', 'role' => UserRole::SuperAdmin],
            ['name' => 'Administrator', 'email' => 'admin@school.com', 'role' => UserRole::Admin],
            ['name' => 'Budi Santoso', 'email' => 'user@school.com', 'role' => UserRole::Admin],
        ];

        foreach ($mainUsers as $user) {
            User::firstOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make('password123'),
                    'role' => $user['role'],
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]
            );
        }

        // 3. AKUN DUMMY NAMA INDONESIA (Hanya 3 Akun)
        $namaIndo = [
            'Budi Santoso', 'Siti Aminah', 'Ahmad Hidayat'
        ];

        foreach ($namaIndo as $nama) {
            // Cek limit 100 sebelum tambah data baru
            if (User::count() >= $limitTotal) break;

            $email = Str::slug($nama) . '@school.com';

            User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $nama,
                    'password' => Hash::make('password123'),
                    'role' => UserRole::Admin,
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]
            );
        }

        // --- BARIS FACTORY SUDAH DIHAPUS AGAR TIDAK JADI 100 AKUN ---

        $this->command->info("Selesai! Total akun sekarang: " . User::count());
    }
}
