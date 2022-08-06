<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // super admin
        Role::find(1)->givePermissionTo(Permission::all());

        // admin pod
        Role::find(2)->givePermissionTo([
            //roles daily report
            'opr daily show',
            'opr daily create',
            'opr daily download',

            // data undel permission
            'opr undel show',
            'opr undel create',
            'opr undel download',

            // data customer permission
            'opr customer show',
            'opr customer download',

        ]);

        // admin opr
        Role::find(3)->givePermissionTo([
            // roles daily report
            'opr daily show',
            'opr daily create',
            'opr daily edit',
            'opr daily delete',
            'opr daily download',
            'opr daily monitoring',

            // data undel permission
            'opr undel show',
            'opr undel create',
            'opr undel update',
            'opr undel download',
            'opr undel delete',

            // data customer permission
            'opr customer show',
            'opr customer download',
            'opr customer action'
        ]);
    }
}
