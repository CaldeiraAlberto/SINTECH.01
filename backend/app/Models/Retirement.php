<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Retirement extends Model
{
    /**
     * Nome da tabela.
     */
    protected $table = 'sintech.retirements';

    /**
     * Campos que podem ser preenchidos.
     */
    protected $fillable = [
        'computer_id',
        'data_aposentacao',
        'motivo',
        'observacoes',
    ];

    /**
     * Conversão automática de tipos.
     */
    protected function casts(): array
    {
        return [
            'computer_id' => 'integer',
            'data_aposentacao' => 'date',
        ];
    }

    /**
     * Uma aposentação pertence a um computador.
     */
    public function computer(): BelongsTo
    {
        return $this->belongsTo(
            Computer::class,
            'computer_id'
        );
    }
}