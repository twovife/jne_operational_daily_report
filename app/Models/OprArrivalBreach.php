<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprArrivalBreach extends Model
{
    use HasFactory;

    protected $fillable = [
        'opr_breach_id',
        'date',
        'date_inbound',
        'opr_customer_account_id',
        'hub',
        'no_awb',
        'origin',
        'goods_desc',
    ];

    public function breach()
    {
        return $this->belongsTo(OprBreach::class, 'opr_breach_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(OprCustomerAccount::class, 'opr_customer_account_id', 'id');
    }
}
