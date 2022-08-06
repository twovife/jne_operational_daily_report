<?php

namespace App\Http\Controllers;

use App\Models\OprUpdatePod;
use App\Http\Requests\StoreOprUpdatePodRequest;
use App\Http\Requests\UpdateOprUpdatePodRequest;
use App\Models\Employee;
use App\Models\Hub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OprUpdatePodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = OprUpdatePod::with('oprPodDetail');


        if (request('from') || request('thru')) {
            $query->whereBetween('date', [request('from'), request('thru')]);
        };

        if (request('hub')) {
            $query->where('hub', request('hub'));
        }

        if (Auth::user()->roles->where('name', 'opr pod')->first()) {
            $query->where('hub', Auth::user()->employee->hub);
        }

        return view('operasional.unstatus.index', [
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
        if (Auth::user()->roles->where('name', 'opr pod')->first()) {
            $employee = Employee::where('hub', Auth::user()->employee->hub);
        } else {
            $employee = Employee::where('hub', '!=', 'KEDIRI');
        }
        return view('operasional.unstatus.create', [
            'hubs' => Hub::all(),
            'employees' => $employee->orderBy('hub')->orderBy('nama')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOprUpdatePodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOprUpdatePodRequest $request)
    {
        $request->authenticate();
        $data = [
            'date' => $request->date,
            'hub' => $request->hub,
            'ttl_runsheet' => $request->ttl_runsheet,
            'open_pod' => count($request->awb),
        ];

        if (count($request->awb) > 0) {
            $length = count($request->awb);
            for ($i = 0; $i < $length; $i++) {
                $dataDetail[] = [
                    'awb' => $request->awb[$i],
                    'runsheet' => $request->runsheet[$i],
                    'user_kurir' => $request->user_kurir[$i],
                    'remark' => $request->remark[$i],
                    'remark_status' => $request->remark_status[$i],
                    'folluw_up' => $request->folluw_up[$i],
                    'closed_date' => $request->closed_date[$i],
                ];
            }
        }

        $query = OprUpdatePod::create($data);
        if (count($request->awb) > 0) {
            $query->oprPodDetail()->createMany($dataDetail);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OprUpdatePod  $oprUpdatePod
     * @return \Illuminate\Http\Response
     */
    public function show(OprUpdatePod $oprUpdatePod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OprUpdatePod  $oprUpdatePod
     * @return \Illuminate\Http\Response
     */
    public function edit(OprUpdatePod $oprUpdatePod)
    {
        if (Auth::user()->roles->where('name', 'opr pod')->first()) {
            $employee = Employee::where('hub', Auth::user()->employee->hub);
        } else {
            $employee = Employee::where('hub', '!=', 'KEDIRI');
        }
        $data = OprUpdatePod::with('oprPodDetail', 'oprPodDetail.employee')->find($oprUpdatePod->id);
        return view('operasional.unstatus.edit', [
            'hubs' => Hub::all(),
            'data' => $data,
            'employees' => $employee->orderBy('hub')->orderBy('nama')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOprUpdatePodRequest  $request
     * @param  \App\Models\OprUpdatePod  $oprUpdatePod
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOprUpdatePodRequest $request, OprUpdatePod $oprUpdatePod)
    {
        $oprUpdatePod->update($request->all());
        return redirect()->route('opr.daily-report.unstatus.edit', $oprUpdatePod->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OprUpdatePod  $oprUpdatePod
     * @return \Illuminate\Http\Response
     */
    public function destroy(OprUpdatePod $oprUpdatePod)
    {
        $oprUpdatePod->oprPodDetail()->delete();
        $oprUpdatePod->delete();
        return redirect()->route('opr.daily-report.unstatus.index')->with('green', 'Your data has been deleted');
    }
}
