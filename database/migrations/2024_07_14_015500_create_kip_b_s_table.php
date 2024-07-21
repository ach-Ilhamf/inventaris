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
        Schema::create('kip_b_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_barang')->nullable();
            $table->string('jenis_barang');
            $table->string('no_register')->nullable();
            $table->string('merk')->nullable();
            $table->string('type')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('bahan')->nullable();
            $table->string('tahun_beli');
            $table->string('no_pabrik')->nullable();
            $table->string('no_rangka')->nullable();
            $table->string('no_mesin')->nullable();
            $table->string('no_polisi')->nullable();
            $table->string('no_bpkb')->nullable();
            $table->string('asal_usul')->nullable();
            $table->decimal('harga', 15, 2);
            $table->decimal('beban_susut', 15, 2)->nullable();
            $table->decimal('nilai_buku', 15 ,2)->nullable();
            $table->enum('kondisi', ['RUSAK BERAT', 'KURANG BAIK', 'BAIK'])->default('BAIK');
            $table->enum('lokasi', ['Kepala Dinas', 'Sekretariat', 'Sekretaris', 'Bidang TI', 'Bidang SIB',
            'Bidang SPBE', 'Ruang Rapat', 'Radio', 'Call Center', 'Server Kominfo']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kip_b_s');
    }
};
