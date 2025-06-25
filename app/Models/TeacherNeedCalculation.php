<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherNeedCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_need_id',
        'calculation_date',
        'calculation_method_id',
        'teacher_existing_count',
        'data',
        'notes',
        'created_by',
        'updated_by',
    ];

    public function teacherNeed()
    {
        return $this->belongsTo(TeacherNeed::class);
    }
}
