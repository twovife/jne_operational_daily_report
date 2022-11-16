<?php

namespace App\Exports;

use App\Models\OprBreach;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class OprBreachExport implements FromView, WithTitle
{
    public function view(): View
    {
        $breaches = OprBreach::with('undelivery', 'undelivery.customer_account', 'undelivery.shipper_name', 'arrivebreach', 'arrivebreach.customer');
        if (request('from') || request('thru')) {
            $breaches->whereBetween('date', [request('from'), request('thru')]);
        };

        if (request('hub')) {
            $breaches->whereHas('undelivery', function ($query) {
                $query->where('hub', request('hub'));
            })->orWhereHas('arrivebreach', function ($query) {
                $query->where('hub', request('hub'));
            });
        }

        if (Auth::user()->employee->kurir) {
            $breaches->whereHas('undelivery', function ($query) {
                $query->where('hub',  Auth::user()->employee->kurir->hub);
            })->orWhereHas('arrivebreach', function ($query) {
                $query->where('hub', Auth::user()->employee->kurir->hub);
            });
        }
        // return $breaches->get();
        // dd($breaches->orderBy('date')->get());
        // return $hub;
        // return $breaches->get();
        return view('operasional.daily-breach.export', [
            'performances' => $breaches->orderBy('date')->get()
        ]);
    }

    public function title(): string
    {
        return 'breach data';
    }
}
