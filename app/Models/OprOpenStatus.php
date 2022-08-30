<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprOpenStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'hub',
        'ttl_runsheet',
        'open_pod',
    ];

    public function details()
    {
        return $this->hasMany(OprOpenStatusDetail::class, 'opr_open_status_id', 'id');
    }
}
