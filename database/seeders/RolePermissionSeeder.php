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
        $permissions = [
            'manage jadwal ppdb',
            'view pendaftaran siswa',
            'manage data pembayaran',
            'view laporan pembayaran',
            'view laporan ppdb',
            'manage users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Roles and assign permissions
        $rolePanitia = Role::firstOrCreate(['name' => 'panitia']);
        $roleStudent = Role::firstOrCreate(['name' => 'student']);
        $rolePanitia->givePermissionTo(['manage jadwal ppdb', 'view pendaftaran siswa']);

        $roleBendahara = Role::firstOrCreate(['name' => 'bendahara']);
        $roleBendahara->givePermissionTo(['manage data pembayaran', 'view laporan pembayaran']);

        $roleKepalaSekolah = Role::firstOrCreate(['name' => 'kepala_sekolah']);
        $roleKepalaSekolah->givePermissionTo(['view laporan ppdb', 'manage users']);

        // Create Users for testing
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

        // Also assign Super Admin role if needed, or just skip for now as not requested.
    }
}
