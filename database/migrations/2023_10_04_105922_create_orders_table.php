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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customers_id');
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->string('company')->nullable();
            $table->string('state');
            $table->string('city');
            $table->string('pincode');
            $table->string('coupon_code')->nullable();
            $table->integer('coupon_value')->nullable();
            $table->integer('order_status');
            $table->enum('payment_type', ['cod','gateway']);
            $table->integer('payment_status');
            $table->string('payment_id');
            $table->integer('total_amt');
            $table->string('added_on');
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
