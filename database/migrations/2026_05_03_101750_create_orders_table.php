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
            $table->foreignId('outlet_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('jenis_pengiriman'); // 'antar' atau 'jemput'
            $table->string('alamat')->nullable();
            $table->string('nama_penerima')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('waktu_pengiriman')->nullable();
            $table->string('metode_pembayaran');
            $table->integer('subtotal');
            $table->integer('ongkir')->default(5000);
            $table->integer('total');
            $table->string('status')->default('pending');
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
