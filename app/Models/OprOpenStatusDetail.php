<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprOpenStatusDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'opr_open_status_id',
        'awb',
        'runsheet',
        'user_kurir',
        'remark',
        'remark_status',
        'follow_up',
        'closed_date',
    ];

    public function openpod()
    {
        return $this->belongsTo(OprOpenStatus::class, 'opr_open_status_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(HrEmployee::class, 'user_kurir', 'id');
    }
}
