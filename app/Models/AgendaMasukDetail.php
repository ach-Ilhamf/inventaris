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
        'merk',
        'tipe',
        'satuan',
        'harga_satuan',
        'biaya_atribusi'
    ];

}
