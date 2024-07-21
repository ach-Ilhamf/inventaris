<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KipB extends Model
{
    use HasFactory;

        /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'kode_barang',
        'jenis_barang',
        'no_register',
        'merk',
        'type',
        'ukuran',
        'bahan',
        'tahun_beli',
        'no_pabrik',
        'no_rangka',
        'no_mesin',
        'no_polisi',
        'no_bpkb',
        'asal_usul',
        'harga',
        'beban_susut',
        'nilai_buku',
        'kondisi',
        'lokasi'
    ];

}
