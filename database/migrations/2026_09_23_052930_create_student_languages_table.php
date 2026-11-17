<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_languages', function (Blueprint $table) {

            $table->id('language_id');

            $table->unsignedBigInteger('studentid');

            $table->string('language_name');

            $table->string('proficiency');

            $table->timestamps();

            $table->foreign('studentid')
                  ->references('studentid')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_languages');
    }
};