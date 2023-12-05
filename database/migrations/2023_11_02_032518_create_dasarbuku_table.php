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
        Schema::create('genre', function (Blueprint $table) {
            $table->integer('id_genre')->unique();
            $table->string('genre');
            $table->string('subgenre');
            $table->timestamps();

        });

        Schema::create('dasarbuku', function (Blueprint $table) {
            $table->integer('id_buku')->unique();
            $table->string('judul');
            $table->integer('id_penulis');
            $table->integer('id_genre');
            $table->double('harga_asli');
            $table->integer('diskon')->nullable();
            $table->integer('stok');
            $table->text('sinopsis');
            $table->timestamps();

            $table->foreign('id_penulis')->references('id_penulis')->on('penulis')->onDelete('cascade');
            $table->foreign('id_genre')->references('id_genre')->on('genre')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dasarbuku');
    }
};
