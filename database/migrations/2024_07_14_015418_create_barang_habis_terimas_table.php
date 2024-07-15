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
        Schema::create('barang_habis_terimas', function (Blueprint $table) {
            $table->string('kode_barang')->primary();
            $table->string('no_spk');
            $table->string('jenis_barang');
            $table->string('kwitansi');
            $table->string('banyak_barang');
            $table->string('harga_satuan');
            $table->string('unit');
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('no_spk')->references('no_spk')->on('spk_terima_barangs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_habis_terimas');
    }
};
