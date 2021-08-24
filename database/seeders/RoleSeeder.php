<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);

        // Rutas comunes
        Permission::create(['name'          => 'admin.home',
                            'description'   => 'Ver el Dashboard'
                            ])->syncRoles([$role1]);

    }
}
