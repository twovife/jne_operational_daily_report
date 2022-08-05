<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprUnDelivery extends Model
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
        return $this->hasMany(OprUnDeliveriesAction::class)->orderBy('action_date');
    }
    public function customer_account()
    {
        return $this->belongsTo(OprCustomerAccount::class, 'opr_customer_account_id', 'id');
    }
    public function shipper_name()
    {
        return $this->belongsTo(Employee::class, 'shipper', 'id');
    }
    public function breach()
    {
        return $this->hasOne(Breach::class, 'opr_un_delivery_id', 'id');
    }
}
