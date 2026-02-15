<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        // Create Permissions
        $permissions = [
            'manage jadwal ppdb',
            'view jadwal ppdb', // New: for Panitia to view but not edit
            'view pendaftaran siswa',
            'manage data pembayaran',
            'view laporan pembayaran',
            'view laporan ppdb',
            'manage users',
            'manage school information', // New
            'manage panitia', // New
            'manage spp', // New
            'manage articles', // New
            'manage suggestions', // New
            'manage selection tests', // New
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Roles and assign permissions
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleAdmin->givePermissionTo([
            'manage jadwal ppdb',
            'manage school information',
            'manage panitia',
            'manage users',
        ]);

        $rolePanitia = Role::firstOrCreate(['name' => 'panitia']);
        // Panitia CANNOT manage jadwal, only view.
        $rolePanitia->givePermissionTo([
            'view jadwal ppdb',
            'view pendaftaran siswa',
            'manage spp',
            'manage articles',
            'manage suggestions',
            'manage selection tests'
        ]);

        $roleStudent = Role::firstOrCreate(['name' => 'student']);

        $roleBendahara = Role::firstOrCreate(['name' => 'bendahara']);
        $roleBendahara->givePermissionTo(['manage data pembayaran', 'view laporan pembayaran']);

        $roleKepalaSekolah = Role::firstOrCreate(['name' => 'kepala_sekolah']);
        $roleKepalaSekolah->givePermissionTo(['view laporan ppdb', 'manage users']);

        // Create Users for testing
        $userAdmin = User::firstOrCreate([
            'email' => 'admin@ppdb.com',
        ], [
            'name' => 'Administrator',
            'password' => Hash::make('password'),
        ]);
        $userAdmin->assignRole($roleAdmin);

        $userPanitia = User::firstOrCreate([
            'email' => 'panitia@ppdb.com',
        ], [
            'name' => 'Panitia PPDB',
            'password' => Hash::make('password'),
        ]);
        $userPanitia->assignRole($rolePanitia);

        $userBendahara = User::firstOrCreate([
            'email' => 'bendahara@ppdb.com',
        ], [
            'name' => 'Bendahara Sekolah',
            'password' => Hash::make('password'),
        ]);
        $userBendahara->assignRole($roleBendahara);

        $userKepalaSekolah = User::firstOrCreate([
            'email' => 'kepala@sekolah.com',
        ], [
            'name' => 'Kepala Sekolah',
            'password' => Hash::make('password'),
        ]);
        $userKepalaSekolah->assignRole($roleKepalaSekolah);
    }
}
