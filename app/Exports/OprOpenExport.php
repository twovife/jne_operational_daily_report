<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class OprOpenExport implements WithMultipleSheets
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function sheets(): array
    {
        return [
            new OprOpenMainExport,
            new OprOpenSecondaryExport
        ];
    }
}
