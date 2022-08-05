<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprDailyPerformance extends Model
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
        'ur_0',
        'd_0',
        'cr_0',
        'u_0',
        'o_0',
        'r_0',

        'date_1',
        'total_1',
        'ur_1',
        'd_1',
        'cr_1',
        'u_1',
        'o_1',
        'r_1',
        'date_2',
        'total_2',
        'ur_2',
        'd_2',
        'cr_2',
        'u_2',
        'o_2',
        'r_2',
        'date_3',
        'total_3',
        'ur_3',
        'd_3',
        'cr_3',
        'u_3',
        'o_3',
        'r_3',
        'date_4',
        'total_4',
        'ur_4',
        'd_4',
        'cr_4',
        'u_4',
        'o_4',
        'r_4',
        'date_5',
        'total_5',
        'ur_5',
        'd_5',
        'cr_5',
        'u_5',
        'o_5',
        'r_5',
        'date_6',
        'total_6',
        'ur_6',
        'd_6',
        'cr_6',
        'u_6',
        'o_6',
        'r_6',
        'date_7',
        'total_7',
        'ur_7',
        'd_7',
        'cr_7',
        'u_7',
        'o_7',
        'r_7',
        'user_id',
        'created_at',
        'updated_at',
    ];
}
