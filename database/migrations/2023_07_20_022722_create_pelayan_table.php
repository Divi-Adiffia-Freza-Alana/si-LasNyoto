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
        Schema::create('pelayan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_user')->required();
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('no_hp');
            $table->string('jk');
            $table->string('status_kehadiran');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelayan');
    }
};
