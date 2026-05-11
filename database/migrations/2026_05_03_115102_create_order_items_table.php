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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            // relasi ke order
            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            // relasi ke menu
            $table->foreignId('menu_id')
                ->constrained()
                ->cascadeOnDelete();

            // detail pembelian
            $table->string('nama');
            $table->integer('qty');
            $table->decimal('harga', 10, 2); // harga saat beli
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
