<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HakAkses extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permissions = [
            "create task",
            "view task",
            "edit task",
            "destroy task"
        ];
        
        foreach ($permissions as $p) {
            Permission::create(["name" => $p]);
        }

        $Pengguna = Role::create(["name" => "superadmin"]);
        $Pengguna->givePermissionsTo(Permission::all());
        $Pengguna = Role::create(["name" => "pengguna"]);
        $Pengguna->givePermissionsTo(permissions: ($permissions[1]));
    }
}
