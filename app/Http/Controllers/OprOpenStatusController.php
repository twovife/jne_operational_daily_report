<?php

namespace App\Http\Controllers;

use App\Models\OprOpenStatus;
use App\Http\Requests\StoreOprOpenStatusRequest;
use App\Http\Requests\UpdateOprOpenStatusRequest;
use App\Models\HrEmployee;
use App\Models\OprHub;
use Illuminate\Support\Facades\Auth;

class OprOpenStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'asd';
        $query = OprOpenStatus::with('details');

        if (request('from') || request('thru')) {
            $query->whereBetween('date', [request('from'), request('thru')]);
        };

        if (request('hub')) {
            $query->where('hub', request('hub'));
        }

        if (Auth::user()->employee->kurir) {
            $hub = OprHub::where('hub', Auth::user()->employee->kurir->hub)->get();
            $query->where('hub', Auth::user()->employee->kurir->hub);
        } else {
            $hub = OprHub::all();
        }
        return view('operasional.unstatus.index', [
            'datas' => $query->paginate(20),
            'hubs' => $hub
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth::user()->employee->kurir) {
            $hub = OprHub::where('hub', Auth::user()->employee->kurir->hub)->get();
            $courier_lists = HrEmployee::with('kurir')->whereHas('kurir', function ($query) {
                $query->where('hub', Auth::user()->employee->kurir->hub)->orderBy('hub')->orderBy('nama');
            });
        } else {
            $hub = OprHub::all();
            $courier_lists = HrEmployee::with('kurir')->whereHas('kurir', function ($query) {
                $query->whereNotNull('id');
            });
        }
        return view('operasional.unstatus.create', [
            'hubs' => $hub,
            'employees' => $courier_lists->orderBy('divisi')->orderBy('nama')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOprOpenStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOprOpenStatusRequest $request)
    {

        $request->authenticate();
        $countAwb = $request->awb ? count($request->awb) : 0;
        $data = [
            'date' => $request->date,
            'hub' => $request->hub,
            'ttl_runsheet' => $request->ttl_runsheet,
        ];
        $countOpen = 0;
        if ($countAwb > 0) {
            $length = $countAwb;
            for ($i = 0; $i < $length; $i++) {
                $dataDetail[] = [
                    'awb' => $request->awb[$i],
                    'runsheet' => $request->runsheet[$i],
                    'user_kurir' => $request->user_kurir[$i],
                    'remark' => $request->remark[$i],
                    'remark_status' => $request->remark_status[$i],
                    'follow_up' => $request->follow_up[$i],
                    'closed_date' => $request->closed_date[$i],
                ];
                if ($request->date <= $request->closed_date[$i]) {
                    $countOpen++;
                }
            }
        }

        $data['open_pod'] = $countOpen;

        $query = OprOpenStatus::create($data);
        if ($countAwb > 0) {
            $query->details()->createMany($dataDetail);
        }

        return redirect()->route('opr.openstatus.unstatus.index')->with('green', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OprOpenStatus  $oprOpenStatus
     * @return \Illuminate\Http\Response
     */
    public function show(OprOpenStatus $oprOpenStatus)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OprOpenStatus  $oprOpenStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(OprOpenStatus $oprOpenStatus)
    {

        if (Auth::user()->employee->kurir) {
            $hub = OprHub::where('hub', Auth::user()->employee->kurir->hub)->get();
            $courier_lists = HrEmployee::with('kurir')->whereHas('kurir', function ($query) {
                $query->where('hub', Auth::user()->employee->kurir->hub)->orderBy('hub')->orderBy('nama');
            });
        } else {
            $hub = OprHub::all();
            $courier_lists = HrEmployee::with('kurir')->whereHas('kurir', function ($query) {
                $query->whereNotNull('id');
            });
        }
        $data = OprOpenStatus::with('details', 'details.employee')->find($oprOpenStatus->id);
        return view('operasional.unstatus.edit', [
            'hubs' => $hub,
            'data' => $data,
            'employees' => $courier_lists->orderBy('divisi')->orderBy('nama')->get(),
        ]);
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
        $oprOpenStatus->update($request->all());
        return redirect()->route('opr.openstatus.unstatus.edit', $oprOpenStatus->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OprOpenStatus  $oprOpenStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(OprOpenStatus $oprOpenStatus)
    {
        $oprOpenStatus->details()->delete();
        $oprOpenStatus->delete();
        return redirect()->route('opr.openstatus.unstatus.index')->with('green', 'Your data has been deleted');
    }
}
