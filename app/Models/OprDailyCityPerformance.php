<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprDailyCityPerformance extends Model
{
    use HasFactory;

    protected $fillable = [
        'inbound_date',
        'zone',
        'hub',
        'total_shipment_cod',
        'total_nominal_cod',
        'date_0',
        'total_0',
        'unrunsheet_0',
        'delivered_0',
        'cr_0',
        'undel_0',
        'open_0',
        'return_0',
        'wh_0',
        'successreturn_0',
        'date_1',
        'total_1',
        'unrunsheet_1',
        'delivered_1',
        'cr_1',
        'undel_1',
        'open_1',
        'return_1',
        'wh_1',
        'successreturn_1',
        'date_2',
        'total_2',
        'unrunsheet_2',
        'delivered_2',
        'cr_2',
        'undel_2',
        'open_2',
        'return_2',
        'wh_2',
        'successreturn_2',
        'closed',
        'user_id',
    ];

    public function islate()
    {
        return $this->hasOne(VOprStatusCityDailyPerformance::class, 'id', 'id');
    }
}
