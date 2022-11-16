<?php

namespace App\Exports;

use App\Models\OprBreach;
use App\Models\OprUndelAction;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class OprUndeliveryBreachExport implements FromView, WithTitle
{
    public function view(): View
    {

        $action = OprBreach::with('undelivery:id,no_awb');
        $action->whereHas('undelivery', function (Builder $query) {
            $query->whereBetween('date', [request('from'), request('thru')]);
            if (request('hub')) {
                $query->where('hub', request('hub'));
            }
            if (Auth::user()->employee->kurir) {
                $query->where('hub', Auth::user()->employee->kurir->hub);
            }
        });


        return view('operasional.daily-undel.breach-export', [
            'performances' => $action->orderBy('date')->orderBy('id')->get(),
        ]);
    }

    public function title(): string
    {
        return 'breach data';
    }
}
