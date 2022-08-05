<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Division::create([
            'divisi' => 'HUB BANJARAN',
            'area' => 'BANJARAN'
        ]);
        Division::create([
            'divisi' => 'HUB NGADILWIH',
            'area' => 'NGADILUWIH'
        ]);
        Division::create([
            'divisi' => 'HUB PARE',
            'area' => 'PARE'
        ]);
        Division::create([
            'divisi' => 'HUB BANYAKAN',
            'area' => 'BANYAKAN'
        ]);
        Division::create([
            'divisi' => 'OPERASIONAL',
            'area' => 'KEDIRI'
        ]);
        Division::create([
            'divisi' => 'ACCOUNTING',
            'area' => 'KEDIRI'
        ]);
        Division::create([
            'divisi' => 'IT',
            'area' => 'KEDIRI'
        ]);
    }
}
