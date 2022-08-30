<?php

namespace App\Http\Controllers;

use App\Exports\OprUndeliveryExport;
use App\Http\Requests\StoreOprUndelRequest;
use App\Http\Requests\UpdateOprUndelRequest;
use App\Models\HrEmployee;
use App\Models\OprCustomerAccount;
use App\Models\OprHub;
use App\Models\OprUndel;
use App\Models\OprUndelAction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class OprUndelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = OprUndel::with('customer_account', 'shipper_name', 'actions');

        if (request('from') || request('thru')) {
            $query->whereBetween('inbound_date', [request('from'), request('thru')]);
        };

        if (request('hub')) {
            $query->where('hub', request('hub'));
        }

        if (Auth::user()->roles->where('name', 'opr pod')->first()) {
            $query->where('hub', Auth::user()->employee->kurir->hub);
        }

        // return $query->get();
        return view('operasional.daily-undel.index', [
            'performances' => $query->paginate(),
            'hubs' => OprHub::all()
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
            $courier_lists = HrEmployee::with('kurir')->whereHas('kurir', function ($query) {
                $query->where('hub', Auth::user()->employee->kurir->hub)->orderBy('hub')->orderBy('nama');
            });
        } else {
            $courier_lists = HrEmployee::with('kurir')->whereHas('kurir', function ($query) {
                $query->whereNotNull('id');
            });
        }
        return view('operasional.daily-undel.create', [
            'customers' => OprCustomerAccount::all(),
            'employees' => $courier_lists->orderBy('divisi')->orderBy('nama')->get(),
            'hubs' => OprHub::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOprUndelRequest $request)
    {
        // return $request->all();
        $request->authenticate();
        $data = $request->all();
        $customer = OprCustomerAccount::find($request->opr_customer_account_id);
        $date = Carbon::createFromFormat('Y-m-d', $request->date_inbound);
        $data['sla'] = $customer->sla_hold;
        $data['date_return'] = $date->addDays($customer->sla_hold);
        $data['status'] = 0;
        $query = OprUndel::create($data);
        if (!$query) {
            throw ValidationException::withMessages([
                'no_awb' => trans('Terjadi Kesalahan Input Data'),
            ]);
        }
        return redirect()->route('opr.undel.edit', $query->id)->with('green', 'Data Berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OprUndel  $oprUndel
     * @return \Illuminate\Http\Response
     */
    public function show(OprUndel $oprUndel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OprUndel  $oprUndel
     * @return \Illuminate\Http\Response
     */
    public function edit(OprUndel $oprUndel)
    {

        $data = OprUndel::with('actions', 'customer_account', 'shipper_name', 'breach')->find($oprUndel->id);
        if (Auth::user()->roles->where('name', 'opr pod')->first()) {
            $employee = HrEmployee::with('kurir')->whereHas('kurir', function ($query) {
                $query->whereNotNull('id');
            });
            $hub = OprHub::where('hub', Auth::user()->employee->hub)->orderBy('id')->get();
        } else {
            $employee = HrEmployee::with('kurir')->whereHas('kurir', function ($query) {
                $query->whereNotNull('id');
            });
            $hub = OprHub::all();
        }

        // return $data;

        return view('operasional.daily-undel.edit', [
            'data' => $data,
            'employees' => $employee->orderBy('divisi')->orderBy('nama')->get(),
            'hubs' => $hub
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OprUndel  $oprUndel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOprUndelRequest $request, OprUndel $oprUndel)
    {
        $data = $request->all();
        $date = Carbon::createFromFormat('Y-m-d', $request->date_inbound);
        $data['date_return'] = $date->addDays($oprUndel->sla);
        $query = $oprUndel->update($data);

        if (!$query) {
            throw ValidationException::withMessages([
                'no_awb' => trans('Terjadi Kesalahan Input Data'),
            ]);
        }

        return redirect()->route('opr.undel.index')->with('green', 'Data Berhasil ditambah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OprUndel  $oprUndel
     * @return \Illuminate\Http\Response
     */
    public function destroy(OprUndel $oprUndel)
    {
        $data = OprUndel::with('breach')->find($oprUndel->id);
        if ($data->img_name) {
            Storage::delete($data->img_name);
        }
        $oprUndel->breach()->delete();
        $oprUndel->actions()->delete();
        $oprUndel->delete();
        return redirect()->route('opr.daily-report.undel.index')->with('green', 'Data Berhasil dihapus');
    }

    public function actDestroy(OprUndelAction $oprUndelAction)
    {
        // return OprUndelAction::all();
        // return $oprUndelAction;
        $oprUndelAction->delete();
        return redirect()->route('opr.undel.edit', $oprUndelAction->opr_undel_id)->with('green', 'Data berhasil ditambahkan');
    }

    public function action(Request $request, OprUndel $oprUndel)
    {
        // return $oprUndel;
        if ($request->data_status == 1) {
            $oprUndel->update([
                'status' => null
            ]);
            $oprUndel->actions()->create([
                'opr_undel_id' => $oprUndel->id,
                'action_date' => $request->action_date ?? date('Y-m-d'),
                'last_action' => $request->last_action,
                'follow_up' => $request->follow_up,
                'description' => $request->description,
            ]);
            return redirect()->route('opr.undel.edit', $oprUndel->id)->with('green', 'Data berhasil ditambahkan');
        }
        if ($request->data_status == 2) {
            $oprUndel->update([
                'status' => 1
            ]);
            $oprUndel->actions()->create([
                'opr_undel_id' => $oprUndel->id,
                'action_date' => $request->action_date ?? date('Y-m-d'),
                'last_action' => $request->last_action,
                'follow_up' => $request->follow_up,
                'description' => $request->description,
            ]);
            return redirect()->route('opr.undel.edit', $oprUndel->id)->with('green', 'Data berhasil ditambahkan & Menutup Tiket');
        }
        if ($request->data_status == 3) {
            $oprUndel->update([
                'status' => 1
            ]);
            $oprUndel->actions()->create([
                'opr_undel_id' => $oprUndel->id,
                'action_date' => $request->action_date ?? date('Y-m-d'),
                'last_action' => $request->last_action,
                'follow_up' => $request->follow_up,
                'description' => $request->description,
            ]);
            $oprUndel->breach()->create([
                'opr_undel_id' => $oprUndel->id,
                'date' => $request->action_date ?? date('Y-m-d'),
                'status' => $request->last_action,
            ]);

            return redirect()->route('opr.breach.edit', $oprUndel->breach->id)->with('green', 'Breach Ditambahkan, silahkan ubah / lengkapi data');
        }
    }

    public function export()
    {
        return Excel::download(new OprUndeliveryExport, 'undelivery.xlsx');
    }
}
