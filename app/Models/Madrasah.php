<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Madrasah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nsm',
        'name',
        'address',
        'madrasah_level_id',
        'regency_id',
        'district_id',
        'village_id',
        'kepala_madrasah',
        'wakakur_name',
        'wakakur_phone',
        'created_by',
        'updated_by',
    ];
}
