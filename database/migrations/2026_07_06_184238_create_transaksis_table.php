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
        Schema::create('transaksis', function (Blueprint $table) {

            $table->id();

            $table->string('user');

            $table->unsignedBigInteger('produk_id');

            $table->string('nama_produk');

            $table->bigInteger('harga');

            $table->integer('jumlah');

            $table->bigInteger('total_harga');

            $table->string('status')
                ->default('Menunggu Pembayaran');

            $table->string('bukti')
                ->nullable();

            $table->timestamps();

            $table->foreign('produk_id')
                ->references('id')
                ->on('produks')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};