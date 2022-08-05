<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // permision
        Permission::create([
            'name' => 'opr daily show'
        ]);
        Permission::create([
            'name' => 'opr daily create'
        ]);
        Permission::create([
            'name' => 'opr daily edit'
        ]);
        Permission::create([
            'name' => 'opr daily delete'
        ]);
        Permission::create([
            'name' => 'opr daily download'
        ]);
        Permission::create([
            'name' => 'opr daily monitoring'
        ]);




        // role
        Role::create([
            'name' => 'super admin',
            'guard_name' => 'web'
        ]);

        // operational roles
        Role::create([
            'name' => 'opr pod',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'opr staff',
            'guard_name' => 'web'
        ]);

        // accounting roles
        Role::create([
            'name' => 'accounting staff',
            'guard_name' => 'web'
        ]);
    }
}
