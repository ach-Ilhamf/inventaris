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
        Schema::create('agenda_masuks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_penyedia');
            $table->string('nama_agenda');
            $table->decimal('nilai_kontrak', 15, 2);
            $table->string('klas_aset');
            $table->date('tgl_masuk');
            $table->string('skp');
            $table->string('bahp');
            $table->date('tgl_bahp');
            $table->string('bast');
            $table->date('tgl_bast');
            $table->enum('dokumen', ['Lengkap', 'Tidak Lengkap'])->default('Lengkap')->nullable();
            $table->string('Keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_penyedia')->references('id')->on('penyedias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_masuks');
    }
};
