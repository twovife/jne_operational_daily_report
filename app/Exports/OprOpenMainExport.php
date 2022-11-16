<?php

namespace App\Exports;

use App\Models\OprOpenStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class OprOpenMainExport implements FromView, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $query = OprOpenStatus::withCount('details');

        if (request('from') || request('thru')) {
            $query->whereBetween('date', [request('from'), request('thru')]);
        };

        if (request('hub')) {
            $query->where('hub', request('hub'));
        }

        if (Auth::user()->employee->kurir) {
            $query->where('hub', Auth::user()->employee->kurir->hub);
        }
        // dd($query->get());
        return view('operasional.unstatus.export', [
            'performances' => $query->get()
        ]);
    }

    public function title(): string
    {
        return 'main data';
    }
}
