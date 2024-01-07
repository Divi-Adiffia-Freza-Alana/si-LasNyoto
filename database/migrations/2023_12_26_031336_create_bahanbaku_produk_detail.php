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
        Schema::create('bahanbaku_produk_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_produk')->required();
            $table->uuid('id_bahan_baku')->required();
            $table->integer('qty'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahanbaku_produk_detail');
    }
};
