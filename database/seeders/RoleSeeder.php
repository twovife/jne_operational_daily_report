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
