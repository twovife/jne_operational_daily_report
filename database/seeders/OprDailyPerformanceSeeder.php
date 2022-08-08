<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class OprDailyPerformanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
