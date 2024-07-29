<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangHabisTerima extends Model
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
        'kode_barang',
        'id_barang',
        'tgl_spk',
        'no_spk',
        'tgl_dpa',
        'no_dpa',
        'banyak_barang',
        'harga_satuan',
        'unit',
        'keterangan'
    ];

}
