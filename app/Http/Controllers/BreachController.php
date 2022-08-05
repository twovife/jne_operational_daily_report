<?php

namespace App\Http\Controllers;

use App\Models\Breach;
use App\Http\Requests\StoreBreachRequest;
use App\Http\Requests\UpdateBreachRequest;
use App\Models\Hub;
use Illuminate\Support\Facades\Auth;

class BreachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breaches = Breach::with('undelivery', 'undelivery.customer_account', 'undelivery.shipper_name');
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


        return view('operasional.daily-breach.index', [
            'datas' => $breaches->paginate(10),
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
        return 'create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBreachRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBreachRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Breach  $breach
     * @return \Illuminate\Http\Response
     */
    public function show(Breach $breach)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Breach  $breach
     * @return \Illuminate\Http\Response
     */
    public function edit(Breach $breach)
    {
        return view('operasional.daily-breach.edit', [
            'data' => $breach
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBreachRequest  $request
     * @param  \App\Models\Breach  $breach
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBreachRequest $request, Breach $breach)
    {
        $data = $request->all();
        if ($request->file('file_input')) {
            $data['img_name'] = $request->file('file_input')->store('brach-images');
        }

        $breach->update($data);

        return redirect()->route('opr.daily-report.breach.index')->with('green', 'Data Telah di Tambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Breach  $breach
     * @return \Illuminate\Http\Response
     */
    public function destroy(Breach $breach)
    {
        //
    }
}
