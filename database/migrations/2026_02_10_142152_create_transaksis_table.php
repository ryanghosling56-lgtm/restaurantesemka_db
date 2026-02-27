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
            $table->unsignedBigInteger('pelanggan_id');
            $table->unsignedBigInteger('meja_id');
            $table->string('kode_booking',20)->unique();
            $table->dateTime('tgl_jam_trx')->useCurrent();
            $table->enum('status_transaksi', ['pending', 'reserved','checkin','done', 'failed']);
            $table->bigInteger('nominal_dp')->default(0);
            $table->string('metode_pembayaran_dp');
            $table->enum('status_pembayaran_dp', ['deny','pending', 'cancel','settlement','expired','refund'])->nullable();
            $table->bigInteger('total_bayar')->default(0);
            $table->bigInteger('kekurangan')->nullable();
            $table->string('metode_pembayaran_trx',100);
            $table->timestamps();

            $table->foreign('pelanggan_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('meja_id')->references('id')->on('mejas')->onDelete('cascade');
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
