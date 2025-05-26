<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view dashboard',
            'view siswa',
            'create siswa',
            'edit siswa',
            'update siswa',
            'delete siswa',

            'view kelas',
            'create kelas',
            'edit kelas',
            'update kelas',
            'delete kelas',

            'show kelas siswa',
            'add kelas siswa',
            'delete kelas siswa',

            'view jurusan',
            'create jurusan',
            'edit jurusan',

            
            'view role',
            'create role',
            'update role',
            'edit role',
            'delete role',

            'view permission',
            'create permission',
            'update permission',
            'edit permission',
            'delete permission',
            'manage permissions',
            'update permissions',

            'view user',
            'create user',
            'update user',
            'delete user',
            'edit user',
            'update user',
            'delete user',

            'view absen',
            'create absen',
            'update absen',
            'edit absen',
            'delete absen',

            'view pelanggaran',
            'create pelanggaran',
            'update pelanggaran',
            'edit pelanggaran',
            'delete pelanggaran',
            'view kategori pelanggaran',
            'create kategori pelanggaran',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superadmin = Role::firstOrCreate(['name' => 'superadmin']);
        $bk = Role::firstOrCreate(['name' => 'bk']);
        $tatip = Role::firstOrCreate(['name' => 'tatip']);
        $sekretaris = Role::firstOrCreate(['name' => 'sekretaris']);
        $walikelas = Role::firstOrCreate(['name' => 'walikelas']);



        $superadmin->givePermissionTo([
            'view dashboard',
            'view siswa',
            'create siswa',
            'edit siswa',
            'update siswa',
            'delete siswa',

            'view kelas',
            'create kelas',
            'edit kelas',
            'update kelas',
            'delete kelas',

            'show kelas siswa',
            'add kelas siswa',
            'delete kelas siswa',

            'view jurusan',
            'create jurusan',
            'edit jurusan',

            'view role',
            'create role',
            'update role',
            'edit role',
            'delete role',

            'view permission',
            'create permission',
            'update permission',
            'edit permission',
            'delete permission',
            'manage permissions',
            'update permissions',

            'view user',
            'create user',
            'update user',
            'delete user',
            'edit user',
            'update user',
            'delete user',

            'view absen',
            'create absen',
            'update absen',
            'edit absen',
            'delete absen',

            'view pelanggaran',
            'create pelanggaran',
            'update pelanggaran',
            'edit pelanggaran',
            'delete pelanggaran',
            'view kategori pelanggaran',
            'create kategori pelanggaran',
        ]);
        $bk->givePermissionTo([
            'view dashboard',
            'view siswa',

            'view absen',
            'create absen',
            'update absen',
            'edit absen',
            'delete absen',

            'view pelanggaran',
            'create pelanggaran',
            'update pelanggaran',
            'edit pelanggaran',
            'delete pelanggaran',
            'view kategori pelanggaran',
            'create kategori pelanggaran',

        ]);

        $tatip->givePermissionTo([
            'view dashboard',
            'view siswa',

            'view pelanggaran',
            'create pelanggaran',
            'update pelanggaran',
            'edit pelanggaran',
            'delete pelanggaran',
            'view kategori pelanggaran',
            'create kategori pelanggaran',

        ]);

        $sekretaris->givePermissionTo([
            'view dashboard',
            'view siswa',

            'view absen',
            'create absen',
            'update absen',
            'edit absen',
            'delete absen',

        ]);

        $walikelas->givePermissionTo([
            'view dashboard',
            'view siswa',


        ]);
    
    }
}