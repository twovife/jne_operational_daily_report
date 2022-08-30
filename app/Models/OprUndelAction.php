<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprUndelAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'opr_un_delivery_id',
        'action_date',
        'last_action',
        'follow_up',
        'description',
    ];

    public function OprUndel()
    {
        return $this->belongsTo(OprUndel::class, 'opr_undel_id', 'id');
    }
}
