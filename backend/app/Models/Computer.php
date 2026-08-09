<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Computer extends Model
{
    /**
     * Nome da tabela no PostgreSQL.
     */
    protected $table = 'sintech.computers';

    /**
     * Campos que podem ser preenchidos em massa.
     */
    protected $fillable = [
        'plaqueta',
        'modelo_cpu',
        'memoria_gb',
        'data_entrada',
        'responsavel_id',
    ];


    /**
     * Conversão automática de tipos.
     */
    protected function casts(): array
    {
        return [
            'data_entrada' => 'date',
            'memoria_gb' => 'integer',
            'responsavel_id' => 'integer',
        ];
    }


    /**
     * Cada computador pertence a um responsável.
     */
    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'responsavel_id'
        );
    }


    /**
     * Um computador pode possuir várias instalações.
     */
    public function installations(): HasMany
    {
        return $this->hasMany(
            Installation::class
        );
    }


    /**
     * Relação com a aposentação.
     *
     * Um computador pode possuir uma aposentação.
     */
    public function retirement(): HasOne
    {
        return $this->hasOne(
            Retirement::class,
            'computer_id'
        );
    }
}