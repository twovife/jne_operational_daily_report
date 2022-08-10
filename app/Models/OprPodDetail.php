<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprPodDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'opr_update_pod_id',
        'awb',
        'runsheet',
        'user_kurir',
        'remark',
        'remark_status',
        'follow_up',
        'closed_date',
    ];

    public function OprUpdatePod()
    {
        return $this->belongsTo(OprUpdatePod::class, 'opr_update_pod_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_kurir', 'id');
    }
}
