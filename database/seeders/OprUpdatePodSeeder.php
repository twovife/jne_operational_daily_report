<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class OprUpdatePodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'opr unstatuspod geberate'
        ]);
        Permission::create([
            'name' => 'opr unstatuspod edit'
        ]);
        Permission::create([
            'name' => 'opr unstatuspod delete'
        ]);
        Permission::create([
            'name' => 'opr unstatuspod download'
        ]);
    }
}
