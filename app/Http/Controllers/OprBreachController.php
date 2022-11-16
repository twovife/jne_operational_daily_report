<?php

namespace App\Http\Controllers;

use App\Exports\OprBreachExport;
use App\Http\Requests\StoreOprBreachRequest;
use App\Http\Requests\UpdateOprBreachRequest;
use App\Models\HrEmployee;
use App\Models\OprArrivalBreach;
use App\Models\OprBreach;
use App\Models\OprCustomerAccount;
use App\Models\OprHub;
use App\Models\OprUndel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class OprBreachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Auth::user()->employee->kurir->id;
        $breaches = OprBreach::with('undelivery', 'undelivery.customer_account', 'undelivery.shipper_name', 'arrivebreach');
        if (request('from') || request('thru')) {
            $breaches->whereBetween('date', [request('from'), request('thru')]);
        };

        if (request('hub')) {
            $breaches->whereHas('undelivery', function ($query) {
                $query->where('hub', request('hub'));
            })->orWhereHas('arrivebreach', function ($query) {
                $query->where('hub', request('hub'));
            });
        }

        if (Auth::user()->employee->kurir) {
            $breaches->whereHas('undelivery', function ($query) {
                $query->where('hub',  Auth::user()->employee->kurir->hub);
            })->orWhereHas('arrivebreach', function ($query) {
                $query->where('hub', Auth::user()->employee->kurir->hub);
            });
        }

        if (Auth::user()->employee->kurir) {
            $hub = OprHub::where('hub', Auth::user()->employee->kurir->hub)->get();
        } else {
            $hub = OprHub::all();
        }

        // return $hub;
        // return $breaches->get();
        return view('operasional.daily-breach.index', [
            'datas' => $breaches->paginate(),
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
        return view('operasional.daily-breach.create', [
            'customers' => OprCustomerAccount::all(),
            'hubs' => $hub
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOprBreachRequest $request)
    {
        $request->authenticate();
        $data = $request->all();
        if ($request->file('file_input')) {
            $data['img_name'] = $request->file('file_input')->store('brach-images');
        }

        $mainData = [
            'date' => $data['date'],
            'status' => $data['status'],
            'reason' => $data['reason'],
            'img_name' => $data['img_name'],
        ];
        // return $mainData;
        $query = OprBreach::create($mainData);
        $query->arrivebreach()->create($request->all());
        return redirect()->route('opr.breach.index')->with('green', 'Data Telah di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OprBreach  $oprBreach
     * @return \Illuminate\Http\Response
     */
    public function show(OprBreach $oprBreach)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OprBreach  $oprBreach
     * @return \Illuminate\Http\Response
     */
    public function edit(OprBreach $oprBreach)
    {
        $oprBreach->load('arrivebreach', 'arrivebreach.customer');
        if (Auth::user()->employee->kurir) {
            $hub = OprHub::where('hub', Auth::user()->employee->kurir->hub)->get();
        } else {
            $hub = OprHub::all();
        }
        // return $oprBreach;
        return view('operasional.daily-breach.edit', [
            'data' => $oprBreach,
            'hubs' => $hub
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OprBreach  $oprBreach
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOprBreachRequest $request, OprBreach $oprBreach)
    {
        $validate = $request->validate([
            'date' => ['required', 'date'],
            'date_inbound' => ['required', 'date'],
            'hub' => ['required', 'string'],
            'no_awb' => ['required', 'string'],
            'origin' => ['required', 'string'],
            'goods_desc' => ['required', 'string'],
            'status' => ['required', 'string'],
            'file_input' => ['image', 'file', 'max:2048']
        ]);
        $data = $request->all();
        $mainData = [
            'date' => $data['date'],
            'status' => $data['status'],
            'reason' => $data['reason'],
        ];

        if ($request->file('file_input')) {
            $mainData['img_name'] = $request->file('file_input')->store('brach-images');
        }



        $oprBreach->update($mainData);
        $arival = OprArrivalBreach::where('opr_breach_id', $oprBreach->id)->first();
        $arival->update($request->all());
        return redirect()->route('opr.breach.index')->with('green', 'Data Telah di Tambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OprBreach  $oprBreach
     * @return \Illuminate\Http\Response
     */

    public function export()
    {
        return Excel::download(new OprBreachExport, 'opr_breach.xlsx');
    }
    public function destroy(OprBreach $oprBreach)
    {
        //
    }
    public function arrivaldestroy(OprBreach $oprBreach)
    {
        $oprBreach->arrivebreach->delete();
        $oprBreach->delete();
        return redirect()->route('opr.breach.index')->with('green', 'Data Telah di Hapus');
    }
}
