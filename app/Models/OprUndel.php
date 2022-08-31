<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprUndel extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'no_awb',
        'hub',
        'origin',
        'shipper',
        'consignee',
        'consignee_addr',
        'phone',
        'goods_desc',
        'undel_code',
        'undel_desc',
        'date_inbound',
        'opr_customer_account_id',
        'sla',
        'date_return',
        'created_at',
        'updated_at',
        'status'
    ];

    public function actions()
    {
        return $this->hasMany(OprUndelAction::class, 'opr_undel_id', 'id')->orderBy('action_date', 'desc');
    }

    public function customer_account()
    {
        return $this->belongsTo(OprCustomerAccount::class, 'opr_customer_account_id', 'id');
    }
    public function shipper_name()
    {
        return $this->belongsTo(HrEmployee::class, 'shipper', 'id');
    }
    public function breach()
    {
        return $this->hasOne(OprBreach::class, 'opr_undel_id', 'id');
    }

    public function aging()
    {
        return $this->hasOne(VOprUndelAging::class, 'id', 'id');
    }
}
