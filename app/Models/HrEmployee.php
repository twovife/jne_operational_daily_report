<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrEmployee extends Model
{
    use HasFactory;


    public function kurir()
    {
        return $this->hasOne(HrCourier::class, 'hc_employee_id', 'id');
    }
}
