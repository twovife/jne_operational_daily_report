<?php

namespace App\Http\Controllers;

use App\Exports\OprDailyPerformanceExport;
use App\Exports\OprDailyPerformanceSummaryExport;
use App\Models\OprDailyPerformance;
use App\Http\Requests\StoreOprDailyPerformanceRequest;
use App\Http\Requests\UpdateOprDailyPerformanceRequest;
use App\Models\OprHub;
use App\Models\VOprSummaryDailyPerformance;
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
        $query = OprDailyPerformance::with('islate')->orderByDesc('inbound_date')->orderBy('hub', 'asc')->orderBy('zone', 'asc');

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

        return view('operasional.daily-report.performa-delivery', [
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

        return view('operasional.daily-report.performa-delivery-create', [
            'hubs' => $hub
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
        // return $request->all();
        $request->authenticate();

        $data = $request->all();
        $data['date_0'] = date('Y-m-d');
        $indikasiClosed = $request->unrunsheet_0 + $request->cr_0 + $request->undel_0 + $request->open_0;

        if ($indikasiClosed == 0) {
            $data['closed'] = 0;
            for ($i = 1; $i <= 8; $i++) {
                $data['date_' . $i] = date('Y-m-d');
                $data['total_' . $i] = $request->total_0;
                $data['delivered_' . $i] = $request->delivered_0;
                $data['successreturn_' . $i] = $request->successreturn_0;
                $data['unrunsheet_' . $i] = $request->unrunsheet_0;
                $data['cr_' . $i] = $request->cr_0;
                $data['undel_' . $i] = $request->undel_0;
                $data['open_' . $i] = $request->open_0;
                $data['return_' . $i] = $request->return_0;
                $data['wh_' . $i] = $request->wh_0;
            }
        }

        $query = OprDailyPerformance::create($data);

        return redirect()->route('opr.dailyperformance.nonexpress.edit', $query->id)->with('green', 'Your data has been created');
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
        if (Auth::user()->employee->kurir) {
            $hub = OprHub::where('hub', Auth::user()->employee->kurir->hub)->get();
        } else {
            $hub = OprHub::all();
        }
        return view('operasional.daily-report.performa-delivery-edit', [
            'data' => $oprDailyPerformance,
            'hubs' => $hub
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
            case '3':
                $request->validate([
                    'total_3' => ['required', 'integer', 'min:0'],
                    'delivered_3' => ['required', 'integer', 'min:0'],
                    'successreturn_3' => ['required', 'integer', 'min:0'],
                    'unrunsheet_3' => ['required', 'integer', 'min:0'],
                    'cr_3' => ['required', 'integer', 'min:0'],
                    'undel_3' => ['required', 'integer', 'min:0'],
                    'open_3' => ['required', 'integer', 'min:0'],
                    'return_3' => ['required', 'integer', 'min:0'],
                    'wh_3' => ['required', 'integer', 'min:0'],
                ], [
                    'total_3.required' => 'Total Cnote H+3 tidak boleh kosong',
                    'delivered_3.min' => 'Delivered H+3 tidak boleh minus',
                    'successreturn_3.*' => 'Sukses Return H+3 tidak boleh kosong,tidak boleh minus & pastikan terisi hanya dengan angka',
                    'unrunsheet_3.*' => 'Kolom Un Runsheet H+3 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'cr_3.*' => 'Kolom Cr H+3 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'undel_3.*' => 'Kolom Return H+3 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'open_3.*' => 'Kolom Unstatus H+3 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'return_3.*' => 'Kolom Return H+3 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'wh_3.*' => 'Kolom WH1 H+3 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                ]);
                break;
            case '4':
                $request->validate([
                    'total_4' => ['required', 'integer', 'min:0'],
                    'delivered_4' => ['required', 'integer', 'min:0'],
                    'successreturn_4' => ['required', 'integer', 'min:0'],
                    'unrunsheet_4' => ['required', 'integer', 'min:0'],
                    'cr_4' => ['required', 'integer', 'min:0'],
                    'undel_4' => ['required', 'integer', 'min:0'],
                    'open_4' => ['required', 'integer', 'min:0'],
                    'return_4' => ['required', 'integer', 'min:0'],
                    'wh_4' => ['required', 'integer', 'min:0'],
                ], [
                    'total_4.required' => 'Total Cnote H+4 tidak boleh kosong',
                    'delivered_4.min' => 'Delivered H+4 tidak boleh minus',
                    'successreturn_4.*' => 'Sukses Return H+4 tidak boleh kosong,tidak boleh minus & pastikan terisi hanya dengan angka',
                    'unrunsheet_4.*' => 'Kolom Un Runsheet H+4 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'cr_4.*' => 'Kolom Cr H+4 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'undel_4.*' => 'Kolom Return H+4 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'open_4.*' => 'Kolom Unstatus H+4 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'return_4.*' => 'Kolom Return H+4 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'wh_4.*' => 'Kolom WH1 H+4 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                ]);
                break;
            case '5':
                $request->validate([
                    'total_5' => ['required', 'integer', 'min:0'],
                    'delivered_5' => ['required', 'integer', 'min:0'],
                    'successreturn_5' => ['required', 'integer', 'min:0'],
                    'unrunsheet_5' => ['required', 'integer', 'min:0'],
                    'cr_5' => ['required', 'integer', 'min:0'],
                    'undel_5' => ['required', 'integer', 'min:0'],
                    'open_5' => ['required', 'integer', 'min:0'],
                    'return_5' => ['required', 'integer', 'min:0'],
                    'wh_5' => ['required', 'integer', 'min:0'],
                ], [
                    'total_5.required' => 'Total Cnote H+5 tidak boleh kosong',
                    'delivered_5.min' => 'Delivered H+5 tidak boleh minus',
                    'successreturn_5.*' => 'Sukses Return H+5 tidak boleh kosong,tidak boleh minus & pastikan terisi hanya dengan angka',
                    'unrunsheet_5.*' => 'Kolom Un Runsheet H+5 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'cr_5.*' => 'Kolom Cr H+5 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'undel_5.*' => 'Kolom Return H+5 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'open_5.*' => 'Kolom Unstatus H+5 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'return_5.*' => 'Kolom Return H+5 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'wh_5.*' => 'Kolom WH1 H+5 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                ]);
                break;
            case '6':
                $request->validate([
                    'total_6' => ['required', 'integer', 'min:0'],
                    'delivered_6' => ['required', 'integer', 'min:0'],
                    'successreturn_6' => ['required', 'integer', 'min:0'],
                    'unrunsheet_6' => ['required', 'integer', 'min:0'],
                    'cr_6' => ['required', 'integer', 'min:0'],
                    'undel_6' => ['required', 'integer', 'min:0'],
                    'open_6' => ['required', 'integer', 'min:0'],
                    'return_6' => ['required', 'integer', 'min:0'],
                    'wh_6' => ['required', 'integer', 'min:0'],
                ], [
                    'total_6.required' => 'Total Cnote H+6 tidak boleh kosong',
                    'delivered_6.min' => 'Delivered H+6 tidak boleh minus',
                    'successreturn_6.*' => 'Sukses Return H+6 tidak boleh kosong,tidak boleh minus & pastikan terisi hanya dengan angka',
                    'unrunsheet_6.*' => 'Kolom Un Runsheet H+6 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'cr_6.*' => 'Kolom Cr H+6 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'undel_6.*' => 'Kolom Return H+6 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'open_6.*' => 'Kolom Unstatus H+6 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'return_6.*' => 'Kolom Return H+6 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'wh_6.*' => 'Kolom WH1 H+6 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                ]);
                break;
            case '7':
                $request->validate([
                    'total_7' => ['required', 'integer', 'min:0'],
                    'delivered_7' => ['required', 'integer', 'min:0'],
                    'successreturn_7' => ['required', 'integer', 'min:0'],
                    'unrunsheet_7' => ['required', 'integer', 'min:0'],
                    'cr_7' => ['required', 'integer', 'min:0'],
                    'undel_7' => ['required', 'integer', 'min:0'],
                    'open_7' => ['required', 'integer', 'min:0'],
                    'return_7' => ['required', 'integer', 'min:0'],
                    'wh_7' => ['required', 'integer', 'min:0'],
                ], [
                    'total_7.required' => 'Total Cnote H+7 tidak boleh kosong',
                    'delivered_7.min' => 'Delivered H+7 tidak boleh minus',
                    'successreturn_7.*' => 'Sukses Return H+7 tidak boleh kosong,tidak boleh minus & pastikan terisi hanya dengan angka',
                    'unrunsheet_7.*' => 'Kolom Un Runsheet H+7 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'cr_7.*' => 'Kolom Cr H+7 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'undel_7.*' => 'Kolom Return H+7 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'open_7.*' => 'Kolom Unstatus H+7 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'return_7.*' => 'Kolom Return H+7 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'wh_7.*' => 'Kolom WH1 H+7 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                ]);
                break;
            case '8':
                $request->validate([
                    'total_8' => ['required', 'integer', 'min:0'],
                    'delivered_8' => ['required', 'integer', 'min:0'],
                    'successreturn_8' => ['required', 'integer', 'min:0'],
                    'unrunsheet_8' => ['required', 'integer', 'min:0'],
                    'cr_8' => ['required', 'integer', 'min:0'],
                    'undel_8' => ['required', 'integer', 'min:0'],
                    'open_8' => ['required', 'integer', 'min:0'],
                    'return_8' => ['required', 'integer', 'min:0'],
                    'wh_8' => ['required', 'integer', 'min:0'],
                ], [
                    'total_8.required' => 'Total Cnote H+8 tidak boleh kosong',
                    'delivered_8.min' => 'Delivered H+8 tidak boleh minus',
                    'successreturn_8.*' => 'Sukses Return H+8 tidak boleh kosong,tidak boleh m8nus & pastikan terisi hanya dengan angka',
                    'unrunsheet_8.*' => 'Kolom Un Runsheet H+8 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'cr_8.*' => 'Kolom Cr H+8 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'undel_8.*' => 'Kolom Return H+8 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'open_8.*' => 'Kolom Unstatus H+8 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'return_8.*' => 'Kolom Return H+8 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
                    'wh_8.*' => 'Kolom WH1 H+0 tidak boleh kosong, tidak boleh minus & pastikan terisi hanya dengan angka',
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

        $data = $request->all();
        if ($request->d_day) {
            $indikasiClosed = request('unrunsheet_' . $request->d_day) + request('cr_' . $request->d_day) + request('undel_' . $request->d_day) + request('open_' . $request->d_day);
            $data['date_' . $request->d_day] = date('Y-m-d');
            if ($indikasiClosed == 0) {
                $data['closed'] = $request->d_day;
                for ($i = $request->d_day + 1; $i <= 8; $i++) {
                    $data['date_' . $i] = date('Y-m-d');
                    $data['total_' . $i] = $request->total_1 ?? $request->total_2 ?? $request->total_3 ?? $request->total_4 ?? $request->total_5 ?? $request->total_6 ?? $request->total_7 ?? $request->total_8;
                    $data['delivered_' . $i] = $request->delivered_1 ?? $request->delivered_2 ?? $request->delivered_3 ?? $request->delivered_4 ?? $request->delivered_5 ?? $request->delivered_6 ?? $request->delivered_7 ?? $request->delivered_8;
                    $data['successreturn_' . $i] = $request->successreturn_1 ?? $request->successreturn_2 ?? $request->successreturn_3 ?? $request->successreturn_4 ?? $request->successreturn_5 ?? $request->successreturn_6 ?? $request->successreturn_7 ?? $request->successreturn_8;
                    $data['unrunsheet_' . $i] = $request->unrunsheet_1 ?? $request->unrunsheet_2 ?? $request->unrunsheet_3 ?? $request->unrunsheet_4 ?? $request->unrunsheet_5 ?? $request->unrunsheet_6 ?? $request->unrunsheet_7 ?? $request->unrunsheet_8;
                    $data['cr_' . $i] = $request->cr_1 ?? $request->cr_2 ?? $request->cr_3 ?? $request->cr_4 ?? $request->cr_5 ?? $request->cr_6 ?? $request->cr_7 ?? $request->cr_8;
                    $data['undel_' . $i] = $request->undel_1 ?? $request->undel_2 ?? $request->undel_3 ?? $request->undel_4 ?? $request->undel_5 ?? $request->undel_6 ?? $request->undel_7 ?? $request->undel_8;
                    $data['open_' . $i] = $request->open_1 ?? $request->open_2 ?? $request->open_3 ?? $request->open_4 ?? $request->open_5 ?? $request->open_6 ?? $request->open_7 ?? $request->open_8;
                    $data['return_' . $i] = $request->return_1 ?? $request->return_2 ?? $request->return_3 ?? $request->return_4 ?? $request->return_5 ?? $request->return_6 ?? $request->return_7 ?? $request->return_8;
                    $data['wh_' . $i] = $request->wh_1 ?? $request->wh_2 ?? $request->wh_3 ?? $request->wh_4 ?? $request->wh_5 ?? $request->wh_6 ?? $request->wh_7 ?? $request->wh_8;
                }
            } else {
                $data['closed'] = null;
                for ($i = $request->d_day + 1; $i <= 8; $i++) {
                    $data['date_' . $i] = null;
                    $data['total_' . $i] = null;
                    $data['delivered_' . $i] = null;
                    $data['successreturn_' . $i] = null;
                    $data['unrunsheet_' . $i] = null;
                    $data['cr_' . $i] = null;
                    $data['undel_' . $i] = null;
                    $data['open_' . $i] = null;
                    $data['return_' . $i] = null;
                    $data['wh_' . $i] = null;
                }
            }
        }

        // return $data;
        $oprDailyPerformance->update($data);
        return redirect()->route('opr.dailyperformance.nonexpress.edit', $oprDailyPerformance->id)->with('green', 'Your data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OprDailyPerformance  $oprDailyPerformance
     * @return \Illuminate\Http\Response
     */
    public function destroy(OprDailyPerformance $oprDailyPerformance)
    {
        // $oprDailyPerformance->OprDailyPerformanceDetail()->delete();
        $oprDailyPerformance->delete();
        return redirect()->route('opr.dailyperformance.nonexpress.index')->with('green', 'Your data has been deleted');
    }

    public function export()
    {
        return Excel::download(new OprDailyPerformanceExport, 'daily_report_non_yes.xlsx');
    }

    public function exportsum()
    {
        return Excel::download(new OprDailyPerformanceSummaryExport, 'dailyReportsum.xlsx');
    }

    public function summary()
    {

        $query = VOprSummaryDailyPerformance::orderBy('inbound_date', 'asc');


        if (request('from') || request('thru')) {
            $query->whereBetween('inbound_date', [request('from'), request('thru')]);
        };

        return view('operasional.daily-report.monitoring', [
            'performances' =>  $query->paginate(20)
        ]);
    }
}
