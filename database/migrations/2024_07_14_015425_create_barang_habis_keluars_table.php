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
        Schema::create('barang_habis_keluars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_barang')->nullable();
            $table->unsignedBigInteger('id_barang');
            $table->date('tgl_keluar');
            $table->string('no_keluar')->nullable();
            $table->integer('banyak_barang');
            $table->decimal('harga_satuan', 15,2);
            $table->string('unit');
            $table->string('keterangan')->nullable();
            $table->timestamps();
            
            $table->foreign('id_barang')->references('id')->on('barang_pakai_habis');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_habis_keluars');
    }
};
