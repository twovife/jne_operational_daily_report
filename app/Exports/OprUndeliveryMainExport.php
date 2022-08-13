<?php

namespace App\Exports;

use App\Models\OprUnDelivery;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class OprUndeliveryMainExport implements FromView, WithTitle
{
    public function view(): View
    {
        $query = OprUnDelivery::with('customer_account', 'shipper_name');

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
        return view('operasional.daily-undel.export', [
            'performances' => $query->get(),
        ]);
    }

    public function title(): string
    {
        return 'Main Data';
    }
}
