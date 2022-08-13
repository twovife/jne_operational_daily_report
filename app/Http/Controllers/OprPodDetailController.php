<?php

namespace App\Http\Controllers;

use App\Models\OprPodDetail;
use App\Http\Requests\StoreOprPodDetailRequest;
use App\Http\Requests\UpdateOprPodDetailRequest;
use App\Models\Employee;
use App\Models\Hub;
use App\Models\OprUpdatePod;
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
        // return $query->get();

        if (request('from') || request('thru')) {
            $query->whereHas('OprUpdatePod', function ($que) {
                $que->whereBetween('date', [request('from'), request('thru')]);
            });
        };

        if (request('hub')) {
            $query->whereHas('OprUpdatePod', function ($que) {
                $que->where('hub',  request('hub'));
            });
        }


        if (Auth::user()->roles->where('name', 'opr pod')->first()) {
            $query->whereHas('OprUpdatePod', function ($que) {
                $que->where('hub',  Auth::user()->employee->hub);
            });
            $employee = Employee::where('hub', Auth::user()->employee->hub);
        } else {
            $employee = Employee::where('hub', '!=', 'KEDIRI');
        }

        // return $query->get();
        return view('operasional.unstatus-detail.index', [
            'datas' => $query->paginate(20),
            'hubs' => Hub::all(),
            'employees' => $employee->orderBy('hub')->orderBy('nama')->get(),
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
        // return $request->all();
        $parent = OprUpdatePod::find($request->opr_update_pod_id);
        OprPodDetail::create($request->all());
        $parent->open_pod = $parent->open_pod + 1;
        $parent->save();
        return redirect()->route('opr.daily-report.unstatus.edit', $request->opr_update_pod_id)->with('green', 'data berhasil di tambahkan');
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
        $data = OprPodDetail::with('employee')->find($oprPodDetail->id);
        return response()->json(['data' => $data]);
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
        $oprPodDetail->update($request->all());
        return redirect()->route('opr.daily-report.unstatus.edit', $oprPodDetail->opr_update_pod_id)->with('green', 'data berhasil di ubah');
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OprPodDetail  $oprPodDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OprPodDetail $oprPodDetail)
    {
        $oprPodDetail->delete();
        $updatePod = OprUpdatePod::find($oprPodDetail->opr_update_pod_id);
        $updatePod->open_pod = $updatePod->open_pod - 1;
        $updatePod->save();
        return redirect()->route('opr.daily-report.unstatus.edit', $oprPodDetail->opr_update_pod_id)->with('green', 'data berhasil di kurangi');
    }
}
