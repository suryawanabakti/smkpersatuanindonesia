<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PendaftaranSiswa;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentDemoSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * =========================
         * 1. SISWA PENDING
         * =========================
         */
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "Siswa Pending {$i}",
                'email' => "pending{$i}@siswa.com",
                'password' => Hash::make('password'),
            ]);

            $user->assignRole('student');

            PendaftaranSiswa::create([
                'user_id' => $user->id,
                'nama_lengkap' => "Siswa Pending {$i}",
                'email' => $user->email,
                'nisn' => '10' . rand(10000000, 99999999),
                'asal_sekolah' => "SMP Negeri {$i}",
                'jurusan_pilihan' => 'TJKT',
                'status' => 'pending',
                'status_konfirmasi' => false,
                'no_hp' => '08123' . rand(100000, 999999),
                'alamat' => "Jl. Pending No. {$i}",
                'jenis_kelamin' => $i % 2 == 0 ? 'P' : 'L',
                'agama' => 'Islam',
                'nama_wali' => 'Orang Tua Pending',
                'pekerjaan_wali' => 'Wiraswasta',
                'no_hp_orang_tua' => '08122' . rand(100000, 999999),
                'alamat_wali' => "Jl. Wali Pending {$i}",
                'penghasilan_wali' => '< 3 Juta',
            ]);
        }

        /**
         * =========================
         * 2. SISWA DITERIMA (BELUM BAYAR)
         * =========================
         */
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "Siswa Diterima {$i}",
                'email' => "diterima{$i}@siswa.com",
                'password' => Hash::make('password'),
            ]);

            $user->assignRole('student');

            PendaftaranSiswa::create([
                'user_id' => $user->id,
                'nama_lengkap' => "Siswa Diterima {$i}",
                'email' => $user->email,
                'nisn' => '20' . rand(10000000, 99999999),
                'asal_sekolah' => "SMP Unggulan {$i}",
                'jurusan_pilihan' => 'TKRO',
                'status' => 'diterima',
                'status_konfirmasi' => true,
                'no_hp' => '08124' . rand(100000, 999999),
                'alamat' => "Jl. Diterima No. {$i}",
                'tempat_lahir' => 'Makassar',
                'tanggal_lahir' => '2008-01-01',
                'jenis_kelamin' => $i % 2 == 0 ? 'P' : 'L',
                'agama' => 'Islam',
                'nama_wali' => 'Orang Tua Diterima',
                'pekerjaan_wali' => 'PNS',
                'no_hp_orang_tua' => '08125' . rand(100000, 999999),
                'alamat_wali' => "Jl. Wali Diterima {$i}",
                'penghasilan_wali' => '3 - 5 Juta',
            ]);
        }

        /**
         * =========================
         * 3. SISWA LUNAS
         * =========================
         */
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => "Siswa Lunas {$i}",
                'email' => "lunas{$i}@siswa.com",
                'password' => Hash::make('password'),
            ]);

            $user->assignRole('student');

            PendaftaranSiswa::create([
                'user_id' => $user->id,
                'nama_lengkap' => "Siswa Lunas {$i}",
                'email' => $user->email,
                'nisn' => '30' . rand(10000000, 99999999),
                'asal_sekolah' => "SMP Favorit {$i}",
                'jurusan_pilihan' => 'TJKT',
                'status' => 'diterima',
                'status_konfirmasi' => true,
                'no_hp' => '08126' . rand(100000, 999999),
                'alamat' => "Jl. Lunas No. {$i}",
                'tempat_lahir' => 'Maros',
                'tanggal_lahir' => '2008-05-05',
                'jenis_kelamin' => $i % 2 == 0 ? 'P' : 'L',
                'agama' => 'Kristen',
                'nama_wali' => 'Orang Tua Lunas',
                'pekerjaan_wali' => 'PNS',
                'no_hp_orang_tua' => '08127' . rand(100000, 999999),
                'alamat_wali' => "Jl. Wali Lunas {$i}",
                'penghasilan_wali' => '> 5 Juta',
            ]);

            Payment::create([
                'user_id' => $user->id,
                'order_id' => 'SPP-' . Str::upper(Str::random(10)),
                'amount' => 1500000,
                'status' => 'paid',
                'description' => 'Pembayaran Daftar Ulang',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
