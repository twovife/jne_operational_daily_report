<?php

namespace App\Http\Controllers;

use App\Models\OprOpenStatusDetail;
use App\Http\Requests\StoreOprOpenStatusDetailRequest;
use App\Http\Requests\UpdateOprOpenStatusDetailRequest;
use App\Models\HrEmployee;
use App\Models\OprHub;
use App\Models\OprOpenStatus;
use Illuminate\Support\Facades\Auth;

class OprOpenStatusDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $query = OprOpenStatusDetail::with('openpod', 'employee');

        if (request('from') || request('thru')) {
            $query->whereHas('openpod', function ($que) {
                $que->whereBetween('date', [request('from'), request('thru')]);
            });
        };

        if (request('hub')) {
            $query->whereHas('openpod', function ($que) {
                $que->where('hub',  request('hub'));
            });
        }


        if (Auth::user()->roles->where('name', 'opr pod')->first()) {
            $query->whereHas('openpod', function ($que) {
                $que->where('hub',  Auth::user()->employee->hub);
            });
            $courier_lists = HrEmployee::with('kurir')->whereHas('kurir', function ($query) {
                $query->where('hub', Auth::user()->employee->kurir->hub)->orderBy('hub')->orderBy('nama');
            });
        } else {
            $courier_lists = HrEmployee::with('kurir')->whereHas('kurir', function ($query) {
                $query->whereNotNull('id');
            });
        }

        // return $query->get();
        return view('operasional.unstatus-detail.index', [
            'datas' => $query->paginate(20),
            'hubs' => OprHub::all(),
            'employees' => $courier_lists->orderBy('divisi')->orderBy('nama')->get(),
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
     * @param  \App\Http\Requests\StoreOprOpenStatusDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOprOpenStatusDetailRequest $request)
    {
        $parent = OprOpenStatus::find($request->opr_open_status_id);
        OprOpenStatusDetail::create($request->all());
        $parent->open_pod = $parent->open_pod + 1;
        $parent->save();
        return redirect()->route('opr.openstatus.unstatus.edit', $request->opr_open_status_id)->with('green', 'data berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OprOpenStatusDetail  $oprOpenStatusDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OprOpenStatusDetail $oprOpenStatusDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OprOpenStatusDetail  $oprOpenStatusDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OprOpenStatusDetail $oprOpenStatusDetail)
    {
        $data = OprOpenStatusDetail::with('employee')->find($oprOpenStatusDetail->id);
        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOprOpenStatusDetailRequest  $request
     * @param  \App\Models\OprOpenStatusDetail  $oprOpenStatusDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOprOpenStatusDetailRequest $request, OprOpenStatusDetail $oprOpenStatusDetail)
    {
        $oprOpenStatusDetail->update($request->all());
        // return $oprOpenStatusDetail;
        return redirect()->route('opr.openstatus.unstatus.edit', $oprOpenStatusDetail->opr_open_status_id)->with('green', 'data berhasil di ubah');
        // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OprOpenStatusDetail  $oprOpenStatusDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OprOpenStatusDetail $oprOpenStatusDetail)
    {
        $oprOpenStatusDetail->delete();
        $updatePod = OprOpenStatus::find($oprOpenStatusDetail->opr_open_status_id);
        $updatePod->open_pod = $updatePod->open_pod - 1;
        $updatePod->save();
        return redirect()->route('opr.openstatus.unstatus.edit', $oprOpenStatusDetail->opr_open_status_id)->with('green', 'data berhasil di kurangi');
    }
}
