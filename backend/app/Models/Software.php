<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table = 'sintech.softwares';

    protected $fillable = [
        'nome',
        'versao',
        'fabricante',
        'licenca',
        'tipo',
        'estado',
        'observacoes',
    ];

    public function installations()
    {
        return $this->hasMany(Installation::class, 'software_id');
    }
}