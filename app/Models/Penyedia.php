<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyedia extends Model
{
    use HasFactory;

    // Definisi relasi morphToMany
    public function agendamasuk()
    {
        return $this->hasMany(AgendaMasuk::class, 'id_penyedia');
    }
    

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'alamat',
    ];
}
