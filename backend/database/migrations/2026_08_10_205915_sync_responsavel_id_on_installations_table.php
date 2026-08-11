<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Sincroniza o responsável das instalações
     * com o responsável atual do computador.
     */
    public function up(): void
    {
        DB::statement("
            UPDATE sintech.installations AS i
            SET responsavel_id = c.responsavel_id
            FROM sintech.computers AS c
            WHERE i.computer_id = c.id
        ");
    }

    /**
     * Sem alteração de dados no rollback.
     */
    public function down(): void
    {
        // Vazio por se tratar de uma migration exclusiva de ajuste de dados
    }
};