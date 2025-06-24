<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_need_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_need_id')->constrained('teacher_needs');
            $table->foreignId('class_level_id')->constrained('class_levels');
            $table->integer('rombel_count')->default(0);
            $table->integer('student_count')->default(0);
            $table->integer('allocation_per_week')->default(0);
            $table->integer('total_hours')->default(0);
            $table->timestamp('created_at')->default(now());
            $table->string('created_by', 100)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_need_details');
    }
};
