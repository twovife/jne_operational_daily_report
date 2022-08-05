<?php

namespace App\Http\Controllers;

use App\Models\DataKaryawan;
use App\Http\Requests\StoreDataKaryawanRequest;
use App\Http\Requests\UpdateDataKaryawanRequest;

class DataKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDataKaryawanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDataKaryawanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataKaryawan  $dataKaryawan
     * @return \Illuminate\Http\Response
     */
    public function show(DataKaryawan $dataKaryawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataKaryawan  $dataKaryawan
     * @return \Illuminate\Http\Response
     */
    public function edit(DataKaryawan $dataKaryawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDataKaryawanRequest  $request
     * @param  \App\Models\DataKaryawan  $dataKaryawan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDataKaryawanRequest $request, DataKaryawan $dataKaryawan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataKaryawan  $dataKaryawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataKaryawan $dataKaryawan)
    {
        //
    }
}
