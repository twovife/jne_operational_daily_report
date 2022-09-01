<?php

namespace App\Http\Controllers;

use App\Models\OprDailyExpressPerformance;
use App\Http\Requests\StoreOprDailyExpressPerformanceRequest;
use App\Http\Requests\UpdateOprDailyExpressPerformanceRequest;
use App\Models\OprHub;
use App\Models\VOprSummaryExpressDailyPerformances;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OprDailyExpressPerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = OprDailyExpressPerformance::orderByDesc('inbound_date')->orderBy('hub', 'asc')->orderBy('zone', 'asc');

        if (request('from') || request('thru')) {
            $query->whereBetween('inbound_date', [request('from'), request('thru')]);
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

        return view('operasional.daily-express-performance.index', [
            'performances' => $query->paginate(20),
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
        } else {
            $hub = OprHub::all();
        }
        return view('operasional.daily-express-performance.create', [
            'hubs' => $hub
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOprDailyExpressPerformanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOprDailyExpressPerformanceRequest $request)
    {
        $request->authenticate();

        $data = $request->all();
        if ($request->unrunsheet_0 && $request->cr_0 && $request->undel_0 && $request->open_0 && $request->wh_0) {
            $data['closed'] = 0;
        }

        $data['date_0'] = date('Y-m-d');


        $query = OprDailyExpressPerformance::create($data);

        return redirect()->route('opr.dailyperformance.express.edit', $query->id)->with('green', 'Your data has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OprDailyExpressPerformance  $oprDailyExpressPerformance
     * @return \Illuminate\Http\Response
     */
    public function show(OprDailyExpressPerformance $oprDailyExpressPerformance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OprDailyExpressPerformance  $oprDailyExpressPerformance
     * @return \Illuminate\Http\Response
     */
    public function edit(OprDailyExpressPerformance $oprDailyExpressPerformance)
    {

        if (Auth::user()->employee->kurir) {
            $hub = OprHub::where('hub', Auth::user()->employee->kurir->hub)->get();
        } else {
            $hub = OprHub::all();
        }
        return view('operasional.daily-express-performance.edit', [
            'data' => $oprDailyExpressPerformance,
            'hubs' => $hub
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOprDailyExpressPerformanceRequest  $request
     * @param  \App\Models\OprDailyExpressPerformance  $oprDailyExpressPerformance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOprDailyExpressPerformanceRequest $request, OprDailyExpressPerformance $oprDailyExpressPerformance)
    {
        switch ($request->d_day) {
            case '0':
                $request->validate([
                    'total_0' => ['required', 'integer', 'min:0'],
                    'delivered_0' => ['required', 'integer', 'min:0'],
                    'successreturn_0' => ['required', 'integer', 'min:0'],
                    'unrunsheet_0' => ['required', 'integer', 'min:0'],
                    'cr_0' => ['required', 'integer', 'min:0'],
                    'undel_0' => ['required', 'integer', 'min:0'],
                    'open_0' => ['required', 'integer', 'min:0'],
                    'return_0' => ['required', 'integer', 'min:0'],
                    'wh_0' => ['required', 'integer', 'min:0'],
                ], [
                    'total_0.required' => 'Total Cnote H+0 tidak boleh kosong',
                    'delivered_0.min' => 'Delivered H+0 tidak boleh minus',
                    'successreturn_0.*' => 'Sukses Return H+0 tidak boleh kosong,tidak boleh minus & pastikan terisi hanya dengan angka',
                    'unrunsheet_0.*' => 'Kolom Un Runsheet H+0 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'cr_0.*' => 'Kolom Cr H+0 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'undel_0.*' => 'Kolom Return H+0 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'open_0.*' => 'Kolom Unstatus H+0 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'return_0.*' => 'Kolom Return H+0 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'wh_0.*' => 'Kolom WH1 H+0 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                ]);
                break;
            case '1':
                $request->validate([
                    'total_1' => ['required', 'integer', 'min:0'],
                    'delivered_1' => ['required', 'integer', 'min:0'],
                    'successreturn_1' => ['required', 'integer', 'min:0'],
                    'unrunsheet_1' => ['required', 'integer', 'min:0'],
                    'cr_1' => ['required', 'integer', 'min:0'],
                    'undel_1' => ['required', 'integer', 'min:0'],
                    'open_1' => ['required', 'integer', 'min:0'],
                    'return_1' => ['required', 'integer', 'min:0'],
                    'wh_1' => ['required', 'integer', 'min:0'],
                ], [
                    'total_1.required' => 'Total Cnote H+1 tidak boleh kosong',
                    'delivered_1.min' => 'Delivered H+1 tidak boleh minus',
                    'successreturn_1.*' => 'Sukses Return H+1 tidak boleh kosong,tidak boleh minus & pastikan terisi hanya dengan angka',
                    'unrunsheet_1.*' => 'Kolom Un Runsheet H+1 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'cr_1.*' => 'Kolom Cr H+1 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'undel_1.*' => 'Kolom Return H+1 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'open_1.*' => 'Kolom Unstatus H+1 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'return_1.*' => 'Kolom Return H+1 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'wh_1.*' => 'Kolom WH1 H+1 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                ]);
                break;
            case '2':
                $request->validate([
                    'total_2' => ['required', 'integer', 'min:0'],
                    'delivered_2' => ['required', 'integer', 'min:0'],
                    'successreturn_2' => ['required', 'integer', 'min:0'],
                    'unrunsheet_2' => ['required', 'integer', 'min:0'],
                    'cr_2' => ['required', 'integer', 'min:0'],
                    'undel_2' => ['required', 'integer', 'min:0'],
                    'open_2' => ['required', 'integer', 'min:0'],
                    'return_2' => ['required', 'integer', 'min:0'],
                    'wh_2' => ['required', 'integer', 'min:0'],
                ], [
                    'total_2.required' => 'Total Cnote H+2 tidak boleh kosong',
                    'delivered_2.min' => 'Delivered H+2 tidak boleh minus',
                    'successreturn_2.*' => 'Sukses Return H+2 tidak boleh kosong,tidak boleh minus & pastikan terisi hanya dengan angka',
                    'unrunsheet_2.*' => 'Kolom Un Runsheet H+2 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'cr_2.*' => 'Kolom Cr H+2 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'undel_2.*' => 'Kolom Return H+2 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'open_2.*' => 'Kolom Unstatus H+2 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'return_2.*' => 'Kolom Return H+2 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'wh_2.*' => 'Kolom WH1 H+2 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
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
                        'inbound_date' => trans('Terjadi Kesalahan Mohon Reload Halaman'),
                    ]);
                    break;
                }
        }

        $indikasiClosed = request('unrunsheet_' . $request->d_day) + request('cr_' . $request->d_day) + request('undel_' . $request->d_day) + request('open_' . $request->d_day) + request('wh_' . $request->d_day);
        $data = $request->all();
        $data['date_' . $request->d_day] = date('Y-m-d');
        if ($indikasiClosed == 0) {
            $data['closed'] = $request->d_day;
        }
        $oprDailyExpressPerformance->update($data);
        return redirect()->route('opr.dailyperformance.express.edit', $oprDailyExpressPerformance->id)->with('green', 'Your data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OprDailyExpressPerformance  $oprDailyExpressPerformance
     * @return \Illuminate\Http\Response
     */
    public function destroy(OprDailyExpressPerformance $oprDailyExpressPerformance)
    {
        $oprDailyExpressPerformance->delete();
        return redirect()->route('opr.dailyperformance.express.index')->with('green', 'Your data has been deleted');
    }

    public function export()
    {
        //
    }

    public function exportsum()
    {
        //
    }

    public function summary()
    {
        $query = VOprSummaryExpressDailyPerformances::paginate(20);
        if (request('from') || request('thru')) {
            $query->whereBetween('inbound_date', [request('from'), request('thru')]);
        };

        return view('operasional.daily-express-performance.monitoring', [
            'performances' =>  $query
        ]);
    }
}
