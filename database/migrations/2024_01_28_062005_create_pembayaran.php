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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_transaksi')->required();
            $table->foreign('id_transaksi')->references('id')->on('transaksi');
            $table->string('foto')->nullable();
            $table->string('url_foto')->nullable();
            $table->integer('jumlah')->nullable();
            $table->enum('status', ['Lunas', 'Cicilan1','Cicilan2'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
