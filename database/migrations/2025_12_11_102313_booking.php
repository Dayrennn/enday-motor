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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking')->unique();
            $table->string('user_id');
            $table->unsignedBigInteger('motor_id');
            $table->string('nama_motor');
            $table->unsignedInteger('jumlah')->default(1);
            $table->date('tanggal_booking');
            $table->bigInteger('uang_muka')->default(0);
            $table->text('catatan')->nullable();
            $table->string('status')->default('Menunggu');
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();

            //relasi tabel motor
            $table->foreign('motor_id')->references('id')->on('data_motor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
