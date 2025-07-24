<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Anggota;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anggotaList = [
            ['nama' => 'I Putu Arta', 'kontak' => '081234567890', 'status' => 'aktif', 'alamat' => 'Jl. Raya Sesetan No.1'],
            ['nama' => 'Kadek Rina', 'kontak' => '081234567891', 'status' => 'aktif', 'alamat' => 'Jl. Dharma Bhakti No.2'],
            ['nama' => 'Made Sari', 'kontak' => '081234567892', 'status' => 'tidak aktif', 'alamat' => 'Jl. Karya Dharma No.3'],
        ];

        foreach ($anggotaList as $data) {
            Anggota::create([
                'id' => Str::uuid(),
                'nama' => $data['nama'],
                'kontak' => $data['kontak'],
                'status' => $data['status'],
                'alamat' => $data['alamat'],
                'foto' => null,
            ]);
        }
    }
}
