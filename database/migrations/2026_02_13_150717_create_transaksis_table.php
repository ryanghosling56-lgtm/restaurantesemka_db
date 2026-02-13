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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->integer('pelanggan_id');
            $table->integer('meja_id');
            $table->string('kode_booking',20)->unique();
            $table->dateTime('tgl_jam_trx')->useCurrent();
            $table->enum('status_transaksi', ['pending', 'reserved','checkin','done', 'failed']);
            $table->bigInteger('nominal_dp')->default(0);
            $table->string('metode_pembayaran_dp');
            $table->enum('status_pembayaran_dp', ['deny','pending', 'cancel','settlement','expired','refund']);
            $table->bigInteger('total_bayar')->default(0);
            $table->bigInteger('kekurangan')->nullable();
            $table->string('metode_pembayaran_trx',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
