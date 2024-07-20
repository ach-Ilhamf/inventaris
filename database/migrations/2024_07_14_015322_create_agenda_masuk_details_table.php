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
        Schema::create('agenda_masuk_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_agenda');
            $table->string('nama_barang');
            $table->string('gambar');
            $table->string('merk')->nullable();
            $table->string('tipe')->nullable();
            $table->string('no_rangka')->nullable();
            $table->string('no_mesin')->nullable();
            $table->string('no_polisi')->nullable();
            $table->string('no_bpkb')->nullable();
            $table->integer('satuan');
            $table->decimal('harga_satuan', 15,2);
            $table->timestamps();

            $table->foreign('id_agenda')->references('id')->on('agenda_masuks');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_masuk_details');
    }
};
