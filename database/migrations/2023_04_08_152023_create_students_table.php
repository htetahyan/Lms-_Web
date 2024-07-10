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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('student_code');
            $table->string('class_id')->nullable();
            $table->date('dob');
            $table->string('mother_name');
            $table->string('father_name');
            $table->string('email')->nullable();
            $table->integer('phone');
            $table->date('enrollment_date');
            $table->longText('student_image_uri');
            $table->string('gender');
            $table->longText('address');
            $table->string('class');
            $table->string('section');
            $table->string('password');
            $table->foreignId('year_id')->constrained('years')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('month')->nullable();
            $table->string('time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
