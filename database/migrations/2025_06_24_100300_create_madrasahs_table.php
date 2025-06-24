<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('madrasahs', function (Blueprint $table) {
            $table->id();
            $table->string('nsm', 50)->unique();
            $table->string('name', 255);
            $table->string('address', 255);
            $table->foreignId('madrasah_level_id')->constrained('madrasah_levels');
            $table->unsignedBigInteger('regency_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('village_id');
            $table->string('kepala_madrasah', 100)->nullable();
            $table->string('wakakur_name', 100)->nullable();
            $table->string('wakakur_phone', 20)->nullable();
            $table->timestamp('created_at')->default(now());
            $table->string('created_by', 100)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('madrasahs');
    }
};
