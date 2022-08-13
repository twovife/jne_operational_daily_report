<?php

namespace App\Exports;

use App\Models\OprUnDeliveriesAction;
use App\Models\OprUnDelivery;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;

class OprUndeliverySecondaryExport implements FromQuery, WithTitle
{
    public function query()
    {
        return OprUnDeliveriesAction::query();
    }

    public function title(): string
    {
        return 'Action Data';
    }
}
