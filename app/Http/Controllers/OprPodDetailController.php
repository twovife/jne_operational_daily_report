<?php

namespace App\Http\Controllers;

use App\Models\OprPodDetail;
use App\Http\Requests\StoreOprPodDetailRequest;
use App\Http\Requests\UpdateOprPodDetailRequest;
use App\Models\Hub;
use Illuminate\Support\Facades\Auth;

class OprPodDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = OprPodDetail::with('OprUpdatePod', 'employee');

        if (request('from') || request('thru')) {
            $query->whereHas('OprUpdatePod', function ($que) {
                $que->whereBetween('date', [request('from'), request('thru')]);
            });
        };

        if (request('hub')) {
            $query->whereHas('undelivery', function ($que) {
                $que->where('hub',  request('hub'));
            });
        }


        if (Auth::user()->roles->where('name', 'opr pod')->first()) {
            $query->whereHas('undelivery', function ($que) {
                $que->where('hub',  Auth::user()->employee->hub);
            });
        }

        return view('operasional.unstatus-detail.index', [
            'datas' => $query->paginate(20),
            'hubs' => Hub::all()
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOprPodDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOprPodDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OprPodDetail  $oprPodDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OprPodDetail $oprPodDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OprPodDetail  $oprPodDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OprPodDetail $oprPodDetail)
    {
        return response()->json(['data' => $oprPodDetail]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOprPodDetailRequest  $request
     * @param  \App\Models\OprPodDetail  $oprPodDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOprPodDetailRequest $request, OprPodDetail $oprPodDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OprPodDetail  $oprPodDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OprPodDetail $oprPodDetail)
    {
        //
    }
}
