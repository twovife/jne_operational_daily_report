<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('http://192.168.1.252:1986/kardiv/', [
            'username' => 'oprapps',
            'api_key' => 'e84567a3b7c29ffa864e'
        ])->json('data');

        foreach ($response as $value) {
            if ($value['divisi'] == 'DELIVERY BANJARAN') {
                $hub = 'BANJARAN';
            } elseif ($value['divisi'] == 'PERWAKILAN NGADILUWIH') {
                $hub = 'NGADILUWIH';
            } elseif ($value['divisi'] == 'PERWAKILAN PARE') {
                $hub = 'PARE';
            } elseif ($value['divisi'] == 'PERWAKILAN BANYAKAN') {
                $hub = 'BANYAKAN';
            } else {
                $hub = 'KEDIRI';
            };
            Employee::updateOrInsert(
                ['id' => $value['id']],
                [
                    'nama' => $value['nama'],
                    'jabatan' => $value['jabatan'],
                    'divisi' => $value['divisi'],
                    'unit' => $value['unit'] ?? $value['divisi'],
                    'kurir' => $value['kurir'],
                    'kendaraan' => $value['kendaraan'],
                    'hub' => $hub,
                    'status' => $value['is_active'],

                ]
            );
        }
    }
}
