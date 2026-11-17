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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('template_id');
            $table->string('title')->nullable();
            $table->text('objective')->nullable();
            $table->text('experience')->nullable();
            $table->text('achievements')->nullable();
            $table->text('language')->nullable();
            $table->text('hobbies')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('userid')->on('users')->onDelete('cascade');
            $table->foreign('template_id')->references('id')->on('resume_templates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
