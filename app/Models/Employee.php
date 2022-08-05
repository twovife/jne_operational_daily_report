<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama',
        'jabatan',
        'area',
        'divisi',
        'unit',
        'status',
        'kurir',
        'kendaraan',
        'hub',
    ];
}
