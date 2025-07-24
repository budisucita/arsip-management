<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah admin@example.com sudah ada
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'id' => Str::uuid(),
                'nama' => 'Admin Utama',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }

        // Tambah 3 user pengurus jika belum ada
        if (User::where('role', 'pengurus')->count() < 3) {
            User::factory(3)->create([
                'role' => 'pengurus',
            ]);
        }
    }
}
