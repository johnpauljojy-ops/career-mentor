<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_educations', function (Blueprint $table) {

            $table->id('education_id');

            $table->unsignedBigInteger('studentid');

            $table->string('qualification_name');

            $table->string('branch_name')->nullable();

            $table->string('institution_name');

            $table->year('start_year')->nullable();

            $table->year('end_year')->nullable();

            $table->decimal('cgpa', 4, 2)->nullable();

            $table->timestamps();

            $table->foreign('studentid')
                  ->references('studentid')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_educations');
    }
};