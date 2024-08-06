<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangPakaiHabis extends Model
{
    use HasFactory;

    public function baranghabisterima()
    {
        return $this->hasMany(BarangHabisTerima::class, 'id_barang');
    }

    public function baranghabiskeluar()
    {
        return $this->hasMany(BarangHabisKeluar::class, 'id_barang', 'id');
    }

            /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'jenis_barang',
        'stok',
    ];

}
