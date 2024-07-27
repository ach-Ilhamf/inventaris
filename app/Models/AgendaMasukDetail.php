<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaMasukDetail extends Model
{
    use HasFactory;

    public function agendamasuk()
    {
        return $this->belongsTo(AgendaMasuk::class, 'id_agenda');
    }

    public function kodebarang()
    {
        return $this->belongsTo(KodeBarang::class, 'kode_barang');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

        /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_agenda',
        'kode_barang',
        'nama_barang',
        'no_register',
        'id_pegawai',
        'gambar',
        'merk',
        'tipe',
        'ukuran',
        'bahan',
        'tahun_beli',
        'no_pabrik',
        'no_rangka',
        'no_mesin',
        'no_polisi',
        'no_bpkb',
        'asal_usul',
        'satuan',
        'harga_satuan',
        'beban_susut',
        'nilai_buku',
        'kondisi',
        'lokasi'
    ];

}
