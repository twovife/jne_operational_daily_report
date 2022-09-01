<?php

namespace App\Exports;

use App\Models\VOprSummaryDailyPerformance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OprDailyPerformanceSummaryExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $query = VOprSummaryDailyPerformance::paginate(20);

        if (request('from') || request('thru')) {
            $query->whereBetween('inbound_date', [request('from'), request('thru')]);
        };

        return view('operasional.daily-report.exportSummary', [
            'performances' =>  $query
        ]);
    }
}
