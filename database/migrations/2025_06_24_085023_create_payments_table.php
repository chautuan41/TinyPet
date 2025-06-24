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
         Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->string('order_code')->unique();
        $table->integer('amount');
        $table->string('status')->default('pending'); // pending, success, failed
        $table->string('vnp_transaction_no')->nullable();
        $table->string('vnp_response_code')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
