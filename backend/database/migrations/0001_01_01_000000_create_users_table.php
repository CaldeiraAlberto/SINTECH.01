<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa as migrations.
     */
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Tabela de Utilizadores
        |--------------------------------------------------------------------------
        */
        Schema::create('sintech.users', function (Blueprint $table) {

            // Chave primária
            $table->id();

            // Número de crachá do funcionário
            $table->string('numero_cracha', 30)->unique();

            // Nome completo
            $table->string('name');

            // Email utilizado para login
            $table->string('email')->unique();

            // Data de verificação do email
            $table->timestamp('email_verified_at')->nullable();

            // Palavra-passe (Laravel guarda em Hash)
            $table->string('password');

            // Perfil do utilizador
            $table->enum('role', [
                'helpdesk',
                'responsavel'
            ])->default('responsavel');

            // Conta ativa?
            $table->boolean('ativo')->default(true);

            // Remember Me
            $table->rememberToken();

            // Datas de criação e atualização
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Recuperação de Palavra-passe
        |--------------------------------------------------------------------------
        */
        Schema::create('sintech.password_reset_tokens', function (Blueprint $table) {

            $table->string('email')->primary();

            $table->string('token');

            $table->timestamp('created_at')->nullable();

        });

        /*
        |--------------------------------------------------------------------------
        | Sessões
        |--------------------------------------------------------------------------
        */
        Schema::create('sintech.sessions', function (Blueprint $table) {

            $table->string('id')->primary();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('sintech.users')
                ->nullOnDelete();

            $table->string('ip_address', 45)->nullable();

            $table->text('user_agent')->nullable();

            $table->longText('payload');

            $table->integer('last_activity')->index();

        });
    }

    /**
     * Remove as tabelas.
     */
    public function down(): void
    {
        Schema::dropIfExists('sintech.sessions');

        Schema::dropIfExists('sintech.password_reset_tokens');

        Schema::dropIfExists('sintech.users');
    }
};
