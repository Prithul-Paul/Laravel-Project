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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('product_name')->nullable();
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->longText('description')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('keywords')->nullable();
            $table->longText('technical_specification')->nullable();
            $table->longText('uses')->nullable();
            $table->longText('warrenty')->nullable();
            $table->integer('status');
            $table->string('lead_time');
            $table->integer('tax_id');
            $table->integer('is_promo');
            $table->integer('is_featured');
            $table->integer('is_discount');
            $table->integer('is_tranding');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
