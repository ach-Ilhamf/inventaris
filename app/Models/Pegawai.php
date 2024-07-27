<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    public function agendamasukdetail()
    {
        return $this->hasMany(AgendaMasukDetail::class, 'id_pegawai');
    }

            /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama_pegawai',
        'nip',
        'unit',
    ];


}
