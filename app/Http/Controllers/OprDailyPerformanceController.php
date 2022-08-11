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
use Illuminate\Validation\ValidationException;
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

        switch ($request->d_day) {
            case '0':
                $request->validate([
                    'total_0' => ['required', 'integer', 'min:0'],
                    'd_0' => ['required', 'integer', 'min:0'],
                    'ur_0' => ['required', 'integer', 'min:0'],
                    'cr_0' => ['required', 'integer', 'min:0'],
                    'u_0' => ['required', 'integer', 'min:0'],
                    'o_0' => ['required', 'integer', 'min:0'],
                    'r_0' => ['required', 'integer', 'min:0'],
                ], [
                    'total_0.required' => 'Total Cnote H+0 tidak boleh kosong',
                    'd_0.min' => 'Delivered H+0 tidak boleh minus',
                    'ur_0' => 'Kolom Un Runsheet H+0 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'rc_0' => 'Kolom Cr H+0 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'u_0' => 'Kolom Return H+0 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'o_0' => 'Kolom Unstatus H+0 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'r_0' => 'Kolom Return H+0 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                ]);
                break;
            case '1':
                $request->validate([
                    'total_1' => ['required', 'integer', 'min:0'],
                    'd_1' => ['required', 'integer', 'min:0'],
                    'ur_1' => ['required', 'integer', 'min:0'],
                    'cr_1' => ['required', 'integer', 'min:0'],
                    'u_1' => ['required', 'integer', 'min:0'],
                    'o_1' => ['required', 'integer', 'min:0'],
                    'r_1' => ['required', 'integer', 'min:0'],
                ], [
                    'total_1.required' => 'Total Cnote H+1 tidak boleh kosong',
                    'd_1.min' => 'Delivered H+1 tidak boleh minus',
                    'ur_1' => 'Kolom Un Runsheet H+1 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'rc_1' => 'Kolom Cr H+1 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'u_1' => 'Kolom Return H+1 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'o_1' => 'Kolom Unstatus H+1 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'r_1' => 'Kolom Return H+1 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                ]);
                break;
            case '2':
                $request->validate([
                    'total_2' => ['required', 'integer', 'min:0'],
                    'd_2' => ['required', 'integer', 'min:0'],
                    'ur_2' => ['required', 'integer', 'min:0'],
                    'cr_2' => ['required', 'integer', 'min:0'],
                    'u_2' => ['required', 'integer', 'min:0'],
                    'o_2' => ['required', 'integer', 'min:0'],
                    'r_2' => ['required', 'integer', 'min:0'],
                ], [
                    'total_2.required' => 'Total Cnote H+2 tidak boleh kosong',
                    'd_2.min' => 'Delivered H+2 tidak boleh minus',
                    'ur_2.*' => 'Kolom Un Runsheet H+2 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'rc_2.*' => 'Kolom Cr H+2 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'u_2.*' => 'Kolom Return H+2 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'o_2.*' => 'Kolom Unstatus H+2 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'r_2.*' => 'Kolom Return H+2 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                ]);
                break;
            case '3':
                $request->validate([
                    'total_3' => ['required', 'integer', 'min:0'],
                    'd_3' => ['required', 'integer', 'min:0'],
                    'ur_3' => ['required', 'integer', 'min:0'],
                    'cr_3' => ['required', 'integer', 'min:0'],
                    'u_3' => ['required', 'integer', 'min:0'],
                    'o_3' => ['required', 'integer', 'min:0'],
                    'r_3' => ['required', 'integer', 'min:0'],
                ], [
                    'total_3.required' => 'Total Cnote H+3 tidak boleh kosong',
                    'd_3.min' => 'Delivered H+3 tidak boleh minus',
                    'ur_3.*' => 'Kolom Un Runsheet H+3 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'rc_3.*' => 'Kolom Cr H+3 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'u_3.*' => 'Kolom Return H+3 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'o_3.*' => 'Kolom Unstatus H+3 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'r_3.*' => 'Kolom Return H+3 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                ]);
                break;
            case '4':
                $request->validate([
                    'total_4' => ['required', 'integer', 'min:0'],
                    'd_4' => ['required', 'integer', 'min:0'],
                    'ur_4' => ['required', 'integer', 'min:0'],
                    'cr_4' => ['required', 'integer', 'min:0'],
                    'u_4' => ['required', 'integer', 'min:0'],
                    'o_4' => ['required', 'integer', 'min:0'],
                    'r_4' => ['required', 'integer', 'min:0'],
                ], [
                    'total_4.required' => 'Total Cnote H+4 tidak boleh kosong',
                    'd_4.min' => 'Delivered H+4 tidak boleh minus',
                    'ur_4.*' => 'Kolom Un Runsheet H+4 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'rc_4.*' => 'Kolom Cr H+4 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'u_4.*' => 'Kolom Return H+4 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'o_4.*' => 'Kolom Unstatus H+4 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'r_4.*' => 'Kolom Return H+4 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                ]);
                break;
            case '5':
                $request->validate([
                    'total_5' => ['required', 'integer', 'min:0'],
                    'd_5' => ['required', 'integer', 'min:0'],
                    'ur_5' => ['required', 'integer', 'min:0'],
                    'cr_5' => ['required', 'integer', 'min:0'],
                    'u_5' => ['required', 'integer', 'min:0'],
                    'o_5' => ['required', 'integer', 'min:0'],
                    'r_5' => ['required', 'integer', 'min:0'],
                ], [
                    'total_5.required' => 'Total Cnote H+5 tidak boleh kosong',
                    'd_5.min' => 'Delivered H+5 tidak boleh minus',
                    'ur_5.*' => 'Kolom Un Runsheet H+5 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'rc_5.*' => 'Kolom Cr H+5 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'u_5.*' => 'Kolom Return H+5 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'o_5.*' => 'Kolom Unstatus H+5 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'r_5.*' => 'Kolom Return H+5 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                ]);
                break;
            case '6':
                $request->validate([
                    'total_6' => ['required', 'integer', 'min:0'],
                    'd_6' => ['required', 'integer', 'min:0'],
                    'ur_6' => ['required', 'integer', 'min:0'],
                    'cr_6' => ['required', 'integer', 'min:0'],
                    'u_6' => ['required', 'integer', 'min:0'],
                    'o_6' => ['required', 'integer', 'min:0'],
                    'r_6' => ['required', 'integer', 'min:0'],
                ], [
                    'total_6.required' => 'Total Cnote H+6 tidak boleh kosong',
                    'd_6.min' => 'Delivered H+6 tidak boleh minus',
                    'ur_6.*' => 'Kolom Un Runsheet H+6 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'rc_6.*' => 'Kolom Cr H+6 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'u_6.*' => 'Kolom Return H+6 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'o_6.*' => 'Kolom Unstatus H+6 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'r_6.*' => 'Kolom Return H+6 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                ]);
                break;
            case '7':
                $request->validate([
                    'total_7' => ['required', 'integer', 'min:0'],
                    'd_7' => ['required', 'integer', 'min:0'],
                    'ur_7' => ['required', 'integer', 'min:0'],
                    'cr_7' => ['required', 'integer', 'min:0'],
                    'u_7' => ['required', 'integer', 'min:0'],
                    'o_7' => ['required', 'integer', 'min:0'],
                    'r_7' => ['required', 'integer', 'min:0'],
                ], [
                    'total_7.required' => 'Total Cnote H+7 tidak boleh kosong',
                    'd_7.min' => 'Delivered H+7 tidak boleh minus',
                    'ur_7.*' => 'Kolom Un Runsheet H+7 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'rc_7.*' => 'Kolom Cr H+7 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'u_7.*' => 'Kolom Return H+7 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'o_7.*' => 'Kolom Unstatus H+7 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                    'r_7.*' => 'Kolom Return H+7 tidak boleh kosong, tidak boleh minus & dan pastikan terisi hanya dengan angka',
                ]);
                break;

            default:
                if ($request->inbound_date) {
                    $request->validate(
                        [
                            'inbound_date' => ['required', 'date'],
                            'zone' => ['required', 'string'],
                            'hub' => ['required', 'string'],
                            'total_shipment_cod' => ['required', 'integer', 'min:0'],
                            'total_nominal_cod' => ['required', 'integer', 'min:0'],
                        ],
                        [
                            'inbound_date.*' => 'Inbound date tidak boleh kosong dan pastikan terisi tanggal',
                            'zone.*' => 'Zone tidak boleh kosong',
                            'hub.*' => 'Hub tidak boleh kosong',
                            'total_shipment_cod.*' => 'Total Shipment Cod tidak boleh kosong, isikan 0 jika Total shipment tidak ada',
                            'total_nominal_cod.*' => 'Total Nominal Cod tidak boleh kosong, isikan 0 jika Total shipment tidak ada',
                        ]
                    );
                } else {
                    throw ValidationException::withMessages([
                        'total_2' => trans('Terjadi Kesalahan Mohon Reload Halaman'),
                    ]);
                    break;
                }
        }
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
