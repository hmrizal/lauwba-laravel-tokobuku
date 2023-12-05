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
        Schema::create('detailbuku', function (Blueprint $table) {
            $table->integer('id_detail')->unique();
            $table->integer('id_buku')->unique();
            $table->string('foto');
            $table->date('tanggal_rilis');
            $table->string('penerbit');
            $table->integer('halaman');
            $table->string('ukuran');
            $table->integer('berat');
            $table->timestamps();

            $table->foreign('id_buku')->references('id_buku')->on('dasarbuku')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailbuku');
    }
};
