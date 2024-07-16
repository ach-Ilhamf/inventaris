<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaMasuk extends Model
{
    use HasFactory;

    public function penyedia()
    {
        return $this->belongsTo(Penyedia::class, 'id_penyedia');
    }

    public function agendadetail()
    {
        return $this->hasMany(AgendaMasukDetail::class, 'id_penyedia');
    }

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_penyedia',
        'nama_agenda',
        'nilai_kontrak',
        'klas_aset',
        'tgl_masuk',
        'skp',
        'bahp',
        'tgl_bahp',
        'bast',
        'tgl_bast',
        'dokumen',
        'Keterangan',
    ];

    
}
