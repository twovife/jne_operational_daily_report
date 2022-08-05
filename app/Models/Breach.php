<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breach extends Model
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
        return $this->belongsTo(OprUnDelivery::class, 'opr_un_delivery_id', 'id');
    }
}
