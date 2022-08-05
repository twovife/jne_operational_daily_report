<?php

namespace App\Http\Controllers;

use App\Exports\OprDailyPerformanceExport;
use App\Exports\OprDailyPerformanceSummaryExport;
use App\Models\OprDailyPerformance;
use App\Http\Requests\StoreOprDailyPerformanceRequest;
use App\Http\Requests\UpdateOprDailyPerformanceRequest;
use App\Models\Hub;
use App\Models\OprDailyPerformanceDetail;
use App\Models\VSummaryOprDailyPerformance;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class OprDailyPerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = OprDailyPerformance::orderByDesc('inbound_date')->orderBy('hub', 'asc')->orderBy('zone', 'asc');

        if (request('from') || request('thru')) {
            $query->whereBetween('inbound_date', [request('from'), request('thru')]);
        };

        if (request('hub')) {
            $query->where('hub', request('hub'));
        }

        if (Auth::user()->roles->where('name', 'opr pod')->first()) {
            $query->where('hub', Auth::user()->employee->hub);
        }
        // return OprDailyPerformance::with('OprDailyPerformanceDetail')->get();
        return view('operasional.daily-report.performa-delivery', [
            'performances' => $query->paginate(),
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
        return view('operasional.daily-report.performa-delivery-create', [
            'hubs' => Hub::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOprDailyPerformanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOprDailyPerformanceRequest $request)
    {
        $request->authenticate();

        $data = $request->all();
        $data['date_0'] = date('Y-m-d');

        $query = OprDailyPerformance::create($data);

        return redirect()->route('opr.daily-report.dailyperformance.edit', $query->id)->with('green', 'Your data has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OprDailyPerformance  $oprDailyPerformance
     * @return \Illuminate\Http\Response
     */
    public function show(OprDailyPerformance $oprDailyPerformance)
    {
        dd($oprDailyPerformance);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OprDailyPerformance  $oprDailyPerformance
     * @return \Illuminate\Http\Response
     */
    public function edit(OprDailyPerformance $oprDailyPerformance)
    {
        // dd($oprDailyPerformance);
        return view('operasional.daily-report.performa-delivery-edit', [
            'data' => $oprDailyPerformance
        ]);
        // return $oprDailyPerformance;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOprDailyPerformanceRequest  $request
     * @param  \App\Models\OprDailyPerformance  $oprDailyPerformance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOprDailyPerformanceRequest $request, OprDailyPerformance $oprDailyPerformance)
    {
        // return $request->all();
        $data = $request->all();
        $data['date_' . $request->d_day] = date('Y-m-d');
        $oprDailyPerformance->update($data);
        return redirect()->route('opr.daily-report.dailyperformance.edit', $oprDailyPerformance->id)->with('green', 'Your data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OprDailyPerformance  $oprDailyPerformance
     * @return \Illuminate\Http\Response
     */
    public function destroy(OprDailyPerformance $oprDailyPerformance)
    {
        $oprDailyPerformance->OprDailyPerformanceDetail()->delete();
        $oprDailyPerformance->delete();
        return redirect()->route('opr.daily-report.dailyperformance.index')->with('green', 'Your data has been deleted');
    }

    public function export()
    {
        return Excel::download(new OprDailyPerformanceExport, 'dailyReport.xlsx');
    }

    public function exportsum()
    {
        return Excel::download(new OprDailyPerformanceSummaryExport, 'dailyReportsum.xlsx');
    }

    public function summary()
    {

        $query = VSummaryOprDailyPerformance::paginate();


        if (request('from') || request('thru')) {
            $query->whereBetween('inbound_date', [request('from'), request('thru')]);
        };

        return view('operasional.daily-report.monitoring', [
            'performances' =>  $query
        ]);
    }
}
