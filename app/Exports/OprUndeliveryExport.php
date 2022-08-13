<?php

namespace App\Exports;

use App\Models\Hub;
use App\Models\OprUnDelivery;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class OprUndeliveryExport implements WithMultipleSheets
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function sheets(): array
    {
        return [
            new OprUndeliveryMainExport(),
            new OprUndeliverySecondaryExport()
        ];
    }
}
