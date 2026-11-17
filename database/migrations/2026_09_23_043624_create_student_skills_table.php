<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_skills', function (Blueprint $table) {

            $table->id('skill_id');

            $table->unsignedBigInteger('studentid');

            $table->string('skill_name');

            $table->timestamps();

            $table->foreign('studentid')
                  ->references('studentid')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_skills');
    }
};