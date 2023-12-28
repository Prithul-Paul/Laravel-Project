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
        //
        Schema::create('product_attribute', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->integer('mrp');
            $table->integer('price');
            $table->integer('qty');
            $table->integer('size_id');
            $table->integer('color_id');
            $table->string('attr_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
