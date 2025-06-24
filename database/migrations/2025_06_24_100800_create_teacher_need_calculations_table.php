<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_need_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_need_id')->constrained('teacher_needs');
            $table->timestamp('calculation_date')->default(now());
            $table->foreignId('calculation_method_id')->constrained('calculation_methods');
            $table->integer('teacher_existing_count')->default(0);
            $table->decimal('result', 5, 2);
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->default(now());
            $table->string('created_by', 100)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_need_calculations');
    }
};
