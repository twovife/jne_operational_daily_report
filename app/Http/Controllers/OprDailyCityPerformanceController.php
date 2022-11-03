<?php

namespace App\Http\Controllers;

use App\Exports\OprDailyPerformanceCityExport;
use App\Exports\OprDailyPerformanceSummaryCityExport;
use App\Models\OprDailyCityPerformance;
use App\Http\Requests\StoreOprDailyCityPerformanceRequest;
use App\Http\Requests\UpdateOprDailyCityPerformanceRequest;
use App\Models\OprHub;
use App\Models\VOprSummaryCityDailyPerformance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class OprDailyCityPerformanceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $query = OprDailyCityPerformance::with('islate')->orderByDesc('inbound_date')->orderBy('hub', 'asc')->orderBy('zone', 'asc');

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

    return view('operasional.daily-city.index', [
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
    return view('operasional.daily-city.create', [
      'hubs' => $hub
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreOprDailyCityPerformanceRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreOprDailyCityPerformanceRequest $request)
  {
    $request->authenticate();

    $data = $request->all();
    $data['date_0'] = date('Y-m-d');
    $indikasiClosed = $request->unrunsheet_0 + $request->cr_0 + $request->undel_0 + $request->open_0;

    if ($indikasiClosed == 0) {
      $data['closed'] = 0;
      for ($i = 1; $i <= 2; $i++) {
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

    $query = OprDailyCityPerformance::create($data);

    return redirect()->route('opr.dailyperformance.ctc.edit', $query->id)->with('green', 'Your data has been created');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\OprDailyCityPerformance  $oprDailyCityPerformance
   * @return \Illuminate\Http\Response
   */
  public function show(OprDailyCityPerformance $oprDailyCityPerformance)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\OprDailyCityPerformance  $oprDailyCityPerformance
   * @return \Illuminate\Http\Response
   */
  public function edit(OprDailyCityPerformance $oprDailyCityPerformance)
  {
    if (Auth::user()->employee->kurir) {
      $hub = OprHub::where('hub', Auth::user()->employee->kurir->hub)->get();
    } else {
      $hub = OprHub::all();
    }
    return view('operasional.daily-city.edit', [
      'data' => $oprDailyCityPerformance,
      'hubs' => $hub
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateOprDailyCityPerformanceRequest  $request
   * @param  \App\Models\OprDailyCityPerformance  $oprDailyCityPerformance
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateOprDailyCityPerformanceRequest $request, OprDailyCityPerformance $oprDailyCityPerformance)
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
    $oprDailyCityPerformance->update($data);
    return redirect()->route('opr.dailyperformance.ctc.edit', $oprDailyCityPerformance->id)->with('green', 'Your data has been updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\OprDailyCityPerformance  $oprDailyCityPerformance
   * @return \Illuminate\Http\Response
   */
  public function destroy(OprDailyCityPerformance $oprDailyCityPerformance)
  {
    $oprDailyCityPerformance->delete();
    return redirect()->route('opr.dailyperformance.ctc.index')->with('green', 'Your data has been deleted');
  }

  public function export()
  {
    return Excel::download(new OprDailyPerformanceCityExport, 'daily_report_ctc.xlsx');
  }

  public function exportsum()
  {
    return Excel::download(new OprDailyPerformanceSummaryCityExport, 'daily_report_summary_yes.xlsx');
  }

  public function summary()
  {
    $query = VOprSummaryCityDailyPerformance::orderBy('inbound_date', 'asc');
    if (request('from') || request('thru')) {
      $query->whereBetween('inbound_date', [request('from'), request('thru')]);
    };

    return view('operasional.daily-express-performance.monitoring', [
      'performances' =>  $query->paginate(20)
    ]);
  }
}
