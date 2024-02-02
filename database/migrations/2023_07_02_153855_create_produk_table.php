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
        Schema::create('produk', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_produk');
            $table->string('nama');
            $table->string('jenis');
            $table->text('deskripsi');
            $table->string('foto');
            $table->string('foto_url');
            $table->integer('harga');
            $table->enum('status', ['Tersedia', 'Kosong']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
