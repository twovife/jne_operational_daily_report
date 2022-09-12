<?php

namespace App\Exports;

use App\Models\VOprSummaryCityDailyPerformance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OprDailyPerformanceSummaryCityExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $query = VOprSummaryCityDailyPerformance::orderBy('inbound_date', 'asc');

        if (request('from') || request('thru')) {
            $query->whereBetween('inbound_date', [request('from'), request('thru')]);
        };

        return view('operasional.daily-city.exportSummary', [
            'performances' =>  $query->get()
        ]);
    }
}
