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
        Schema::create('diskons', function (Blueprint $table) {
            $table->id();
            $table->string('nama_diskon'); // contoh: Promo Hemat
            $table->string('gambar')->nullable(); // banner
            $table->text('deskripsi')->nullable(); // teks promo
            $table->integer('persen')->default(0);

            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_akhir')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskons');
    }
};
