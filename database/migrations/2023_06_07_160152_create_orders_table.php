<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_id')->unique();
            $table->integer('total');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('status')->default('pending');
            $table->foreignId('billing_id')->constrained('addresses', 'id');
            $table->foreignId('shipping_id')->constrained('addresses', 'id');
            $table->foreignId('payment_id')->constrained('payments', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};