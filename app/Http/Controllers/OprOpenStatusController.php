<?php

namespace App\Http\Controllers;

use App\Models\OprOpenStatus;
use App\Http\Requests\StoreOprOpenStatusRequest;
use App\Http\Requests\UpdateOprOpenStatusRequest;

class OprOpenStatusController extends Controller
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
     * @param  \App\Http\Requests\StoreOprOpenStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOprOpenStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OprOpenStatus  $oprOpenStatus
     * @return \Illuminate\Http\Response
     */
    public function show(OprOpenStatus $oprOpenStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OprOpenStatus  $oprOpenStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(OprOpenStatus $oprOpenStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOprOpenStatusRequest  $request
     * @param  \App\Models\OprOpenStatus  $oprOpenStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOprOpenStatusRequest $request, OprOpenStatus $oprOpenStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OprOpenStatus  $oprOpenStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(OprOpenStatus $oprOpenStatus)
    {
        //
    }
}
