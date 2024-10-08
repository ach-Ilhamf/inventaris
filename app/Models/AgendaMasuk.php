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
        return $this->hasMany(AgendaMasukDetail::class, 'id_agenda');
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
        'spm',
        'tgl_spm',
        'sp2d',
        'tgl_sp2d',
        'bahp',
        'tgl_bahp',
        'bast',
        'tgl_bast',
        'dokumen',
        'Keterangan',
    ];

    
}
