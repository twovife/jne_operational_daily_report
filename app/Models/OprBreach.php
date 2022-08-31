<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprBreach extends Model
{
    use HasFactory;

    protected $fillable = [
        'opr_un_delivery_id',
        'date',
        'status',
        'reason',
        'img_name',
    ];

    public function undelivery()
    {
        return $this->belongsTo(OprUndel::class, 'opr_undel_id', 'id');
    }

    public function arrivebreach()
    {
        return $this->hasOne(OprArrivalBreach::class, 'opr_breach_id', 'id');
    }
}
