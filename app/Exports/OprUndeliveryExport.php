<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\Exportable;
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
            new OprUndeliveryMainExport,
            new OprUndeliverySecondaryExport,
            new OprUndeliveryBreachExport,
        ];
    }
}
