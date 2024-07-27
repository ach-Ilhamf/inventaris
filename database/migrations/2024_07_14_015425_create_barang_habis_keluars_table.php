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
            $table->string('jenis_barang');
            $table->date('tgl_keluar');
            $table->string('no_keluar');
            $table->integer('banyak_barang');
            $table->decimal('harga_satuan', 15,2);
            $table->string('unit');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('no_keluar')->references('no_keluar')->on('spk_keluar_barangs');

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
