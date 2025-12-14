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
        Schema::create('data_motor', function (Blueprint $table) {
            $table->id();
            $table->string('nama_motor');
            $table->string('merk_motor');
            $table->string('images');
            $table->string('caption');
            $table->text('spesifikasi');
            $table->text('description')->nullable();
            $table->decimal('harga_awal', 15, 2);
            $table->decimal('diskon')->nullable();
            $table->decimal('harga_setelah_diskon', 15, 2);
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
