<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOprBreachRequest;
use App\Models\OprBreach;
use App\Models\OprHub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OprBreachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $breaches = OprBreach::with('undelivery', 'undelivery.customer_account', 'undelivery.shipper_name');
        if (request('from') || request('thru')) {
            $breaches->whereBetween('date', [request('from'), request('thru')]);
        };
        if (request('hub')) {
            $breaches->whereHas('undelivery', function ($query) {
                $query->where('hub', request('hub'));
            });
        }

        if (Auth::user()->roles->where('name', 'opr pod')->first()) {
            $breaches->whereHas('undelivery', function ($query) {
                $query->where('hub',  Auth::user()->employee->hub);
            });
        }

        // return $breaches->get();
        return view('operasional.daily-breach.index', [
            'datas' => $breaches->paginate(10),
            'hubs' => OprHub::all()
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OprBreach  $oprBreach
     * @return \Illuminate\Http\Response
     */
    public function show(OprBreach $oprBreach)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OprBreach  $oprBreach
     * @return \Illuminate\Http\Response
     */
    public function edit(OprBreach $oprBreach)
    {
        return view('operasional.daily-breach.edit', [
            'data' => $oprBreach
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OprBreach  $oprBreach
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOprBreachRequest $request, OprBreach $oprBreach)
    {
        $data = $request->all();
        if ($request->file('file_input')) {
            $data['img_name'] = $request->file('file_input')->store('brach-images');
        }

        $oprBreach->update($data);

        return redirect()->route('opr.breach.index')->with('green', 'Data Telah di Tambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OprBreach  $oprBreach
     * @return \Illuminate\Http\Response
     */
    public function destroy(OprBreach $oprBreach)
    {
        //
    }
}
