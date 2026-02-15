<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionNewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view jadwal ppdb',
            'manage jadwal ppdb',
            'manage selection tests', // New
            'manage school information',
            'manage panitia', // New
            'manage spp', // New
            'manage users', // New
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        $roleAdmin = Role::where('name', 'admin')->first();
        $roleAdmin->givePermissionTo([
            'manage jadwal ppdb',
            'manage school information',
            'manage panitia',
            'manage users',
        ]);
    }
}
