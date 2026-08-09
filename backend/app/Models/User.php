<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Nome da tabela.
     */
    protected $table = 'sintech.users';

    /**
     * Campos que podem ser preenchidos em massa.
     */
    protected $fillable = [
        'numero_cracha',
        'name',
        'email',
        'password',
        'role',
        'ativo',
    ];

    /**
     * Campos ocultos.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversão automática de tipos.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'ativo' => 'boolean',
        ];
    }

    /**
     * Relação com computadores.
     *
     * Um responsável pode estar associado
     * a vários computadores.
     */
    public function computers(): HasMany
    {
        return $this->hasMany(
            Computer::class,
            'responsavel_id'
        );
    }
}