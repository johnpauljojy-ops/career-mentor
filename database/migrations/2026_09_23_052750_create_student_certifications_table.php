<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_certifications', function (Blueprint $table) {

            $table->id('certification_id');

            $table->unsignedBigInteger('studentid');

            $table->string('certification_name');

            $table->string('issuing_organization');

            $table->date('issue_date')->nullable();

            $table->timestamps();

            $table->foreign('studentid')
                  ->references('studentid')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_certifications');
    }
};