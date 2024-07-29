<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangHabisKeluar extends Model
{
    use HasFactory;

    public function barangpakaihabis()
    {
        return $this->belongsTo(BarangPakaiHabis::class, 'id_barang');
    }

            /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_barang',
        'tgl_keluar',
        'no_keluar',
        'banyak_barang',
        'harga_satuan',
        'unit',
        'keterangan'
    ];

}
