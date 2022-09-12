<?php

namespace App\Exports;

use App\Models\VOprSummaryExpressDailyPerformances;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OprDailyPerformanceSummaryExpressExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $query = VOprSummaryExpressDailyPerformances::orderBy('inbound_date', 'asc');

        if (request('from') || request('thru')) {
            $query->whereBetween('inbound_date', [request('from'), request('thru')]);
        };

        return view('operasional.daily-express-performance.exportSummary', [
            'performances' =>  $query->get()
        ]);
    }
}
