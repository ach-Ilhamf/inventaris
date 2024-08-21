<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeBarang extends Model
{
    use HasFactory;

    public function agendadetail()
    {
        return $this->hasMany(AgendaMasukDetail::class, 'kode_barang', 'kode_barang');
    }

        /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'kode_barang',
        'jenis_barang'
    ];

}
