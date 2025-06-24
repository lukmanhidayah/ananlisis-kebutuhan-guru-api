<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherNeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'madrasah_id',
        'subject_id',
        'academic_year_id',
        'calculation_method_id',
        'created_by',
        'updated_by',
    ];
}
