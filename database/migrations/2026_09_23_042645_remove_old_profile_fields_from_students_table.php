<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Changes were already applied.
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {

            $table->text('skill')->nullable();
            $table->text('projects')->nullable();
            $table->text('certification')->nullable();

        });
    }
};