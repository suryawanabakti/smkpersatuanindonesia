<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $userAdmin = User::firstOrCreate([
            'email' => 'admin@ppdb.com',
        ], [
            'name' => 'Admin PPDB',
            'password' => Hash::make('password'),
        ]);
        $userAdmin->assignRole($roleAdmin);
    }
}
