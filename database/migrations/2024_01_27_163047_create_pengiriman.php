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
        Schema::create('pengiriman', function (Blueprint $table) {    
            //pengiriman
            $table->uuid('id')->primary();
            $table->uuid('id_kurir')->required();
            $table->string('nopol')->nullable();
            $table->string('kendaraan')->nullable();
            $table->date('tgl_kirim')->nullable();
            $table->text('alamat')->nullable();
            $table->string('nama_penerima')->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};
