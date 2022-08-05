<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Support\Facades\Http;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('mng.employee.emp-index', [
            'employees' => Employee::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**3678 21-juni 2230-0100
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function import()
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
        return redirect()->route('mng.employee.index')->with('green', 'data telah selesai di laod');
    }
}
