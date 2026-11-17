<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('plan_id');
                $table->decimal('amount', 10, 2);
                $table->string('payment_method');
                $table->string('payment_status')->default('pending');
                $table->timestamp('paid_at')->nullable();
                $table->timestamps();

                $table->foreign('user_id')->references('userid')->on('users')->onDelete('cascade');
                $table->foreign('plan_id')->references('id')->on('subscription_plans')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};