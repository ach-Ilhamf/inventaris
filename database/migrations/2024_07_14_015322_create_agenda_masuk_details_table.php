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
            $table->unsignedBigInteger('id_agenda')->nullable();
            $table->string('kode_barang')->nullable();
            $table->string('nama_barang');
            $table->string('no_register')->nullable();
            $table->unsignedBigInteger('id_pegawai');
            $table->string('gambar')->nullable();
            $table->string('merk')->nullable();
            $table->string('tipe')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('bahan')->nullable();
            $table->string('tahun_beli');
            $table->string('no_pabrik')->nullable();
            $table->string('no_rangka')->nullable();
            $table->string('no_mesin')->nullable();
            $table->string('no_polisi')->nullable();
            $table->string('no_bpkb')->nullable();
            $table->string('asal_usul')->nullable();
            $table->integer('satuan')->default(1);
            $table->decimal('harga_satuan', 15,2);
            $table->decimal('beban_susut', 15, 2)->nullable();
            $table->decimal('nilai_buku', 15 ,2)->nullable();
            $table->enum('kondisi', ['Baik', 'Kurang Baik', 'Rusak Berat'])->default('Baik');
            $table->enum('lokasi', ['Kepala Dinas', 'Sekretariat', 'Sekretaris', 'Bidang TI', 'Bidang SIB',
            'Bidang SPBE', 'Ruang Rapat', 'Radio', 'Call Center', 'Server Kominfo']);
            $table->timestamps();

            $table->foreign('id_agenda')->references('id')->on('agenda_masuks')->onDelete('cascade');
            $table->foreign('kode_barang')->references('kode_barang')->on('kode_barangs');
            $table->foreign('id_pegawai')->references('id')->on('pegawais');

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
