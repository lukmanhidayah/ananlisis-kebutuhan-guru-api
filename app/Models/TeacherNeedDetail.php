<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherNeedDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_need_id',
        'class_level_id',
        'rombel_count',
        'student_count',
        'allocation_per_week',
        'total_hours',
        'created_by',
        'updated_by',
    ];
}
