<?php

namespace Database\Seeders;

use App\Models\kades;
use App\Models\petugas;
use App\Models\sifat_arsip;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'Petugas 1',
            'password' => bcrypt('12345678'),
            'level_user' => 'petugas'
        ]);
        User::factory()->create([
            'username' => 'Petugas 2',
            'password' => bcrypt('12345678'),
            'level_user' => 'petugas'
        ]);
        User::factory()->create([
            'username' => 'Kades',
            'password' => bcrypt('12345678'),
            'level_user' => 'kades'
        ]);
        
        petugas::create([
            'nip' => '00001',
            'nama' => 'Petugas-1',
            'tgl_lahir' => Carbon::parse('1990-01-01'),
            'jabatan' => 'Ketua Tata Laksana',
            'alamat' => 'Yogyakarta',
            'no_telp' => '0988875672',
            'id_users' => 1,
        ]);
        petugas::create([
            'nip' => '00012',
            'nama' => 'Petugas-2',
            'tgl_lahir' => Carbon::parse('1980-01-01'),
            'jabatan' => 'Sekretaris Desa',
            'alamat' => 'Yogyakarta',
            'no_telp' => '09887876864',
            'id_users' => 2,
        ]);

        kades::create([
            'nip' => '00123',
            'nama' => 'Kades',
            'tgl_lahir' => Carbon::parse('1970-01-01'),
            'jabatan' => 'Kepala Desa',
            'alamat' => 'Yogyakarta',
            'no_telp' => '09887876864',
            'id_users' => 3,
        ]);

        sifat_arsip::create([
            'kode_sifat' => '01',
            'nama_sifat' => 'Segera'
        ]);
        sifat_arsip::create([
            'kode_sifat' => '02',
            'nama_sifat' => 'Sangat Segera'
        ]);
        sifat_arsip::create([
            'kode_sifat' => '03',
            'nama_sifat' => 'Rahasia'
        ]);
    }
}
