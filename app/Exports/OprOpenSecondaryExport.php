<?php

namespace App\Exports;

use App\Models\OprOpenStatusDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class OprOpenSecondaryExport implements FromView, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $query = OprOpenStatusDetail::with('openpod', 'employee');

        if (request('from') || request('thru')) {
            $query->whereHas('openpod', function ($que) {
                $que->whereBetween('date', [request('from'), request('thru')]);
            });
        };

        if (request('hub')) {
            $query->whereHas('openpod', function ($que) {
                $que->where('hub',  request('hub'));
            });
        }


        if (Auth::user()->employee->kurir) {
            $query->whereHas('openpod', function ($que) {
                $que->where('hub', Auth::user()->employee->kurir->hub);
            });
        }


        // return $query->get();
        return view('operasional.unstatus.detail-export', [
            'performances' => $query->get(),
        ]);
    }

    public function title(): string
    {
        return 'detail data';
    }
}
