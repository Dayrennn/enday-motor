<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class penjualan extends Migration
{
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->dateTime('tanggal');
            $table->unsignedBigInteger('pelanggan_id');
            $table->unsignedBigInteger('motor_id');
            $table->unsignedInteger('jumlah')->default(1);
            $table->bigInteger('total')->default(0);
            $table->enum('status', ['pending', 'dp', 'diproses', 'selesai', 'batal'])->default('pending');
            $table->timestamps();
            $table->foreign('pelanggan_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('motor_id')->references('id')->on('data_motor')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
}
