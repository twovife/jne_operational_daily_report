<?php

namespace App\Exports;

use App\Models\OprUndel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class OprUndeliveryMainExport implements FromView, WithTitle
{
    public function view(): View
    {
        $query = OprUndel::with('aging', 'customer_account', 'shipper_name', 'actions');

        if (request('from') || request('thru')) {
            $query->whereBetween('date', [request('from'), request('thru')]);
        };

        if (request('hub')) {
            $query->where('hub', request('hub'));
        }

        if (Auth::user()->employee->kurir) {
            $query->where('hub', Auth::user()->employee->kurir->hub);
        }

        return view('operasional.daily-undel.export', [
            'performances' => $query->orderBy('date')->get(),
        ]);
    }

    public function title(): string
    {
        return 'main data';
    }
}
