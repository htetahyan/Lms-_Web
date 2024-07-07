<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entrance_tests', function (Blueprint $table) {
            $table->id();
            $table->string('exam_type');
            $table->string('exam_code');
            $table->integer('total_questions_count');
            $table->string('exam_name');
            $table->longText('description');
            $table->string('allowed_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrance_tests');
    }
};
