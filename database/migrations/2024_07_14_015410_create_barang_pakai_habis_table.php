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
        Schema::create('barang_pakai_habis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis_barang');
            $table->integer('stok')->nullable();
            $table->decimal('harga_satuan', 15,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_pakai_habis');
    }
};
