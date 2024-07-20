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


        /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_agenda',
        'nama_barang',
        'gambar',
        'merk',
        'tipe',
        'no_rangka',
        'no_mesin',
        'no_polisi',
        'no_bpkb',
        'satuan',
        'harga_satuan',
    ];

}
