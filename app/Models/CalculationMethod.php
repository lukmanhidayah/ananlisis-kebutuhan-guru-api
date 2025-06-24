<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculationMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'divisor_value',
        'created_by',
        'updated_by',
    ];
}
