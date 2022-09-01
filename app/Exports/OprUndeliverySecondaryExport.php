

<?php

namespace App\Exports;

use App\Models\OprUndel;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class OprUndeliverySecondaryExport implements FromView, WithTitle
{
    public function view(): View
    {
        $query = OprUndel::with('aging', 'customer_account', 'shipper_name', 'actions');

        if (request('from') || request('thru')) {
            $query->whereBetween('inbound_date', [request('from'), request('thru')]);
        };

        if (request('hub')) {
            $query->where('hub', request('hub'));
        }

        if (Auth::user()->employee->kurir) {
            $query->where('hub', Auth::user()->employee->kurir->hub);
        }

        // return OprDailyPerformance::with('OprDailyPerformanceDetail')->get();
        return view('operasional.daily-undel.export', [
            'performances' => $query->get(),
        ]);
    }

    public function title(): string
    {
        return 'Action Data';
    }
}
