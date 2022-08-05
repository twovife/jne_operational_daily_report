<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class BreachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'opr breach show'
        ]);
        Permission::create([
            'name' => 'opr breach create' // this permission includes create, update status and add last action
        ]);
        Permission::create([
            'name' => 'opr breach delete'
        ]);
        Permission::create([
            'name' => 'opr breach update' // this permission just for who can update main data
        ]);
    }
}
