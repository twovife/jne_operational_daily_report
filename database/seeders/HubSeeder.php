<?php

namespace Database\Seeders;

use App\Models\Hub;
use Illuminate\Database\Seeder;

class HubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Hub::create([
            'hub' => 'BANJARAN'
        ]);

        Hub::create([
            'hub' => 'BANYAKAN'
        ]);

        Hub::create([
            'hub' => 'NGADILUWIH'
        ]);

        Hub::create([
            'hub' => 'PARE'
        ]);
    }
}
