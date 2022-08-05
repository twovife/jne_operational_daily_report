<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UndelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'opr undel show'
        ]);
        Permission::create([
            'name' => 'opr undel create' // this permission includes create, update status and add last action
        ]);
        Permission::create([
            'name' => 'opr undel delete'
        ]);
        Permission::create([
            'name' => 'opr undel update' // this permission just for who can update main data
        ]);
        Permission::create([
            'name' => 'opr undel download'
        ]);
        Permission::create([
            'name' => 'opr customer show'
        ]);
        Permission::create([
            'name' => 'opr customer download'
        ]);
        Permission::create([
            'name' => 'opr customer action'
        ]);
    }
}
