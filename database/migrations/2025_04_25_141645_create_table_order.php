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
            $table->id('order_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('product_id');
            $table->string('customer_name');
            $table->string('product_name');
            $table->integer('quantity');

            // ✅ Gunakan decimal untuk menyimpan harga secara presisi
            $table->decimal('price', 15, 2);
            $table->decimal('total_price', 15, 2);

            $table->string('payment_methods')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();

            $table->string('name_shipment_type')->nullable();
            $table->unsignedBigInteger('shipment_types')->nullable();

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
