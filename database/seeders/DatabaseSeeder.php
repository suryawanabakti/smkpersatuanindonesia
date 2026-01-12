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
        // User::factory(10)->create();

        $this->call([
            RolePermissionSeeder::class,
            // StudentDemoSeeder::class,
        ]);

        \App\Models\SchoolInformation::create([
            'name' => 'Sekolah Unggulan',
            'description' => 'Mewujudkan generasi cerdas dan berkarakter.',
            'email' => 'info@sekolah.sch.id',
            'phone' => '081234567890',
            'address' => 'Jl. Pendidikan No. 123, Kota Pelajar',
            'facebook_url' => 'https://facebook.com',
            'instagram_url' => 'https://instagram.com',
            'youtube_url' => 'https://youtube.com',
        ]);
    }
}
