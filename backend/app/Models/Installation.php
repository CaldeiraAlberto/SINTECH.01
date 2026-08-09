<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Installation extends Model
{
    /**
     * Nome da tabela no banco de dados.
     */
    protected $table = 'sintech.installations';

    /**
     * Campos preenchíveis.
     */
    protected $fillable = [
        'computer_id',
        'software_id',
        'responsavel_id',
        'data_instalacao',
        'instalado_por',
        'estado',
        'observacoes',
    ];

    /**
     * Conversão automática de tipos.
     */
    protected function casts(): array
    {
        return [
            'data_instalacao' => 'date',
            'responsavel_id' => 'integer',
            'computer_id' => 'integer',
            'software_id' => 'integer',
        ];
    }

    /**
     * Relação com o computador.
     *
     * Uma instalação pertence a um computador.
     */
    public function computer(): BelongsTo
    {
        return $this->belongsTo(
            Computer::class,
            'computer_id'
        );
    }

    /**
     * Relação com o software.
     *
     * Uma instalação pertence a um software.
     */
    public function software(): BelongsTo
    {
        return $this->belongsTo(
            Software::class,
            'software_id'
        );
    }

    /**
     * Relação com o responsável.
     *
     * Uma instalação pertence a um responsável.
     */
    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'responsavel_id'
        );
    }
}