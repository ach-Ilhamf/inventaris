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
            $table->bigIncrements('id');
            $table->string('kode_barang');
            $table->unsignedBigInteger('id_barang');
            $table->date('tgl_terima');
            $table->date('tgl_spk');
            $table->string('no_spk');
            $table->date('tgl_dpa')->nullable();
            $table->string('no_dpa');
            $table->integer('banyak_barang');
            $table->decimal('harga_satuan');
            $table->string('unit');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_barang')->references('id')->on('barang_pakai_habis')->onDelete('cascade');
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
