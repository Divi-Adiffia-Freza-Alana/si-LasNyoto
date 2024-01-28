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
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_produk')->required();
            $table->foreign('id_produk')->references('id')->on('produk');
            $table->uuid('id_transaksi')->required();
            $table->foreign('id_transaksi')->references('id')->on('transaksi');
            //$table->uuid('id_transaksi')->required();
           // $table->foreign('id_transaksi')->references('id')->on('transaksi');
            $table->integer('qty'); 
            $table->integer('harga'); 
            $table->integer('subtotal');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_detail');
    }
};
