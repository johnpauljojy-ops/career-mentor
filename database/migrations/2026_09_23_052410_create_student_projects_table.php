<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_projects', function (Blueprint $table) {

            $table->id('project_id');

            $table->unsignedBigInteger('studentid');

            $table->string('project_title');

            $table->text('description');

            $table->string('technologies');

            $table->string('project_url')->nullable();

            $table->date('start_date')->nullable();

            $table->date('end_date')->nullable();

            $table->timestamps();

            $table->foreign('studentid')
                  ->references('studentid')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_projects');
    }
};