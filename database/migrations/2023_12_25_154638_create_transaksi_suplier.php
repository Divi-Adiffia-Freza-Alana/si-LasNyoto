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
        Schema::create('transaksi_suplier', function (Blueprint $table) {
            $table->uuid('id')->primary();
         //   $table->uuid('id_suplier')->required();
            $table->string('nama_toko');
            $table->string('kode');
            $table->datetime('tgl_transaksi');
            $table->integer('total');
            $table->string('status_bayar');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_suplier');
    }
};
