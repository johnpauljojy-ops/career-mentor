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
        Schema::table('resumes', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('template_id');
            $table->string('email')->nullable()->after('full_name');
            $table->string('phone')->nullable()->after('email');
            $table->string('location')->nullable()->after('phone');
            $table->text('education')->nullable()->after('objective');
            $table->text('skills')->nullable()->after('experience');
            $table->text('ai_job_description')->nullable()->after('hobbies');
            $table->integer('ai_score')->nullable()->after('ai_job_description');
            $table->integer('ai_deficiency')->nullable()->after('ai_score');
            $table->longText('ai_suggestions')->nullable()->after('ai_deficiency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->dropColumn([
                'full_name',
                'email',
                'phone',
                'location',
                'education',
                'skills',
                'ai_job_description',
                'ai_score',
                'ai_deficiency',
                'ai_suggestions'
            ]);
        });
    }
};
