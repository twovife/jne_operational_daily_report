<?php

namespace App\Exports;

use App\Models\OprDailyPerformance;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class OprDailyPerformanceExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $query = OprDailyPerformance::with('islate')->orderBy('inbound_date', 'asc')->orderBy('hub', 'asc')->orderBy('zone', 'asc');

        if (request('from') || request('thru')) {
            $query->whereBetween('inbound_date', [request('from'), request('thru')]);
        };

        if (request('hub')) {
            $query->where('hub', request('hub'));
        }

        if (Auth::user()->employee->kurir) {
            $query->where('hub', Auth::user()->employee->kurir->hub);
        }


        return view('operasional.daily-report.export', [
            'performances' => $query->get()
        ]);
    }
}
