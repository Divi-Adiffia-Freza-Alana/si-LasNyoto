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
            $table->uuid('id')->primary();
            $table->string('kode');
            $table->uuid('id_konsumen')->required();
            $table->foreign('id_konsumen')->references('id')->on('users');
            $table->uuid('id_kurir')->required();
            $table->foreign('id_kurir')->references('id')->on('users');
            $table->uuid('id_marketing')->required();
            $table->foreign('id_marketing')->references('id')->on('users');
            $table->uuid('id_metode_pembayaran')->required();
            $table->foreign('id_metode_pembayaran')->references('id')->on('metode_pembayaran');
            $table->uuid('id_sph')->required()->nullable();
            $table->uuid('id_pengiriman')->required();
           // $table->foreign('id_sph')->references('id')->on('sph');
            $table->date('tgl_transaksi');
            $table->datetime('estimasi')->nullable();
      //    $table->string('nama');
     //     $table->string('no_hp');
           // $table->text('alamat');
            $table->integer('total')->nullable();
            $table->enum('jenispembayaran', ['Tunai','Kredit']);
            $table->enum('tipe', ['Custom','Regular']);
            $table->string('statusorder');


       //     $table->string('status_bayar');
            $table->timestamps();
            $table->softDeletes();
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
