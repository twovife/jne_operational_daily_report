<?php

namespace App\Http\Controllers;

use App\Models\OprCustomerAccount;
use App\Http\Requests\StoreOprCustomerAccountRequest;
use App\Http\Requests\UpdateOprCustomerAccountRequest;

class OprCustomerAccountController extends Controller
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
     * @param  \App\Http\Requests\StoreOprCustomerAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOprCustomerAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OprCustomerAccount  $oprCustomerAccount
     * @return \Illuminate\Http\Response
     */
    public function show(OprCustomerAccount $oprCustomerAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OprCustomerAccount  $oprCustomerAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(OprCustomerAccount $oprCustomerAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOprCustomerAccountRequest  $request
     * @param  \App\Models\OprCustomerAccount  $oprCustomerAccount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOprCustomerAccountRequest $request, OprCustomerAccount $oprCustomerAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OprCustomerAccount  $oprCustomerAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(OprCustomerAccount $oprCustomerAccount)
    {
        //
    }

    public function apishow()
    {

        $params = request('search');
        $query = OprCustomerAccount::where('nomor_account', 'like', '%' . $params . '%')
            ->orWhere('customer_name', 'like', '%' . $params . '%')
            ->orWhere('customer_grouping', 'like', '%' . $params . '%')->get();
        // return count($query) > 0 ? 'yes' : 'no';

        if (!$params) {
            return response()->json(['data' => 'Resource not found'], 404);
        }

        return  response()->json(['data' => $query]);
    }
}
