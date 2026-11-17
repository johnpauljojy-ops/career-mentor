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
            $table->id('studentid');
            $table->unsignedBigInteger('userid'); // Foreign Key to users
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('qualification_id')->nullable(); // Qualification Foreign Key
            $table->unsignedBigInteger('branch_id')->nullable(); // Branch Foreign Key
            $table->string('collegename')->nullable();
            $table->decimal('cgpa', 4, 2)->nullable();
            $table->year('graduation_year')->nullable();
            $table->text('skill')->nullable();
            $table->text('projects')->nullable();
            $table->text('certification')->nullable();
            $table->text('interest')->nullable();
            $table->text('carrergoal')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('userid')->references('userid')->on('users')->onDelete('cascade');
            $table->foreign('qualification_id')->references('qualification_id')->on('qualifications')->onDelete('set null');
            $table->foreign('branch_id')->references('branch_id')->on('branches')->onDelete('set null');
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
