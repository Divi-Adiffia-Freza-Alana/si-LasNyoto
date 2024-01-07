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
        Schema::create('transaction_bahanbaku', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_bahanbaku')->required();
            $table->foreign('id_bahanbaku')->references('id')->on('bahan_baku');
            $table->float('stok_awal');
            $table->float('stok_terpakai');
            $table->float('sisa');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_bahanbaku');
    }
};
