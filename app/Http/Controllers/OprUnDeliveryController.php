<?php

namespace App\Http\Controllers;

use App\Exports\OprUndeliveryExport;
use App\Models\OprUnDelivery;
use App\Http\Requests\StoreOprUnDeliveryRequest;
use App\Http\Requests\UpdateOprUnDeliveryRequest;
use App\Models\Employee;
use App\Models\Hub;
use App\Models\OprCustomerAccount;
use App\Models\OprUnDeliveriesAction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class OprUnDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = OprUnDelivery::with('customer_account', 'shipper_name', 'actions');

        if (request('from') || request('thru')) {
            $query->whereBetween('inbound_date', [request('from'), request('thru')]);
        };

        if (request('hub')) {
            $query->where('hub', request('hub'));
        }

        if (Auth::user()->roles->where('name', 'opr pod')->first()) {
            $query->where('hub', Auth::user()->employee->hub);
        }

        // return $query->get();
        return view('operasional.daily-undel.index', [
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
        if (Auth::user()->roles->where('name', 'opr pod')->first()) {
            $employee = Employee::where('hub', Auth::user()->employee->hub);
        } else {
            $employee = Employee::where('hub', '!=', 'KEDIRI');
        }
        return view('operasional.daily-undel.create', [
            'customers' => OprCustomerAccount::all(),
            'employees' => $employee->orderBy('hub')->orderBy('nama')->get(),
            'hubs' => Hub::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOprUnDeliveryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOprUnDeliveryRequest $request)
    {
        $request->authenticate();
        $data = $request->all();
        $customer = OprCustomerAccount::find($request->opr_customer_account_id);
        $date = Carbon::createFromFormat('Y-m-d', $request->date_inbound);
        $data['sla'] = $customer->sla_hold;
        $data['date_return'] = $date->addDays($customer->sla_hold);
        $data['status'] = 0;
        $query = OprUnDelivery::create($data);
        if (!$query) {
            throw ValidationException::withMessages([
                'no_awb' => trans('Terjadi Kesalahan Input Data'),
            ]);
        }
        return redirect()->route('opr.daily-report.undel.edit', $query->id)->with('green', 'Data Berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OprUnDelivery  $oprUnDelivery
     * @return \Illuminate\Http\Response
     */
    public function show(OprUnDelivery $oprUnDelivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OprUnDelivery  $oprUnDelivery
     * @return \Illuminate\Http\Response
     */
    public function edit(OprUnDelivery $oprUnDelivery)
    {
        $data = OprUnDelivery::with('customer_account', 'shipper_name', 'actions', 'breach')->find($oprUnDelivery->id);
        if (Auth::user()->roles->where('name', 'opr pod')->first()) {
            $employee = Employee::where('hub', Auth::user()->employee->hub)->orderBy('hub')->orderBy('nama')->get();
            $hub = Hub::where('hub', Auth::user()->employee->hub)->orderBy('id')->get();
        } else {
            $employee = Employee::where('hub', '!=', 'KEDIRI')->orderBy('hub')->orderBy('nama')->get();
            $hub = Hub::all();
        }
        // return $data;
        // return $employee;
        return view('operasional.daily-undel.edit', [
            'data' => $data,
            'employees' => $employee,
            'hubs' => $hub
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOprUnDeliveryRequest  $request
     * @param  \App\Models\OprUnDelivery  $oprUnDelivery
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOprUnDeliveryRequest $request, OprUnDelivery $oprUnDelivery)
    {
        // return $request->all();
        $data = $request->all();
        $date = Carbon::createFromFormat('Y-m-d', $request->date_inbound);
        $data['date_return'] = $date->addDays($oprUnDelivery->sla);
        $query = $oprUnDelivery->update($data);

        if (!$query) {
            throw ValidationException::withMessages([
                'no_awb' => trans('Terjadi Kesalahan Input Data'),
            ]);
        }

        return redirect()->route('opr.daily-report.undel.index')->with('green', 'Data Berhasil ditambah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OprUnDelivery  $oprUnDelivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(OprUnDelivery $oprUnDelivery)
    {
        $data = OprUnDelivery::with('breach')->find($oprUnDelivery->id);
        if ($data->img_name) {
            Storage::delete($data->img_name);
        }
        $oprUnDelivery->breach()->delete();
        $oprUnDelivery->actions()->delete();
        $oprUnDelivery->delete();
        return redirect()->route('opr.daily-report.undel.index')->with('green', 'Data Berhasil dihapus');
    }

    public function actDestroy(OprUnDeliveriesAction $OprUnDeliveriesAction)
    {
        $OprUnDeliveriesAction->delete();
        return redirect()->route('opr.daily-report.undel.edit', $OprUnDeliveriesAction->opr_un_delivery_id)->with('green', 'Data berhasil ditambahkan');
    }

    public function action(Request $request, OprUnDelivery $oprUnDelivery)
    {
        if ($request->data_status == 1) {
            $oprUnDelivery->update([
                'status' => null
            ]);
            $oprUnDelivery->actions()->create([
                'opr_un_delivery_id' => $oprUnDelivery->id,
                'action_date' => $request->action_date ?? date('Y-m-d'),
                'last_action' => $request->last_action,
                'follow_up' => $request->follow_up,
                'description' => $request->description,
            ]);
            return redirect()->route('opr.daily-report.undel.edit', $oprUnDelivery->id)->with('green', 'Data berhasil ditambahkan');
        }
        if ($request->data_status == 2) {
            $oprUnDelivery->update([
                'status' => 1
            ]);
            $oprUnDelivery->actions()->create([
                'opr_un_delivery_id' => $oprUnDelivery->id,
                'action_date' => $request->action_date ?? date('Y-m-d'),
                'last_action' => $request->last_action,
                'follow_up' => $request->follow_up,
                'description' => $request->description,
            ]);
            return redirect()->route('opr.daily-report.undel.edit', $oprUnDelivery->id)->with('green', 'Data berhasil ditambahkan & Menutup Tiket');
        }
        if ($request->data_status == 3) {
            $oprUnDelivery->update([
                'status' => 1
            ]);
            $oprUnDelivery->actions()->create([
                'opr_un_delivery_id' => $oprUnDelivery->id,
                'action_date' => $request->action_date ?? date('Y-m-d'),
                'last_action' => $request->last_action,
                'follow_up' => $request->follow_up,
                'description' => $request->description,
            ]);
            $oprUnDelivery->breach()->create([
                'opr_un_delivery_id' => $oprUnDelivery->id,
                'date' => $request->action_date ?? date('Y-m-d'),
                'status' => $request->last_action,
            ]);

            return redirect()->route('opr.daily-report.breach.edit', $oprUnDelivery->breach->id)->with('green', 'Breach Ditambahkan, silahkan ubah / lengkapi data');
        }
    }
    public function export()
    {
        return Excel::download(new OprUndeliveryExport, 'undelivery.xlsx');
    }
}
