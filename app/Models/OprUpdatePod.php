<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprUpdatePod extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'hub',
        'ttl_runsheet',
        'open_pod',
    ];

    public function oprPodDetail()
    {
        return $this->hasMany(OprPodDetail::class, 'opr_update_pod_id', 'id');
    }
}
