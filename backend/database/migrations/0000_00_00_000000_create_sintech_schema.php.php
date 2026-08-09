<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Cria o schema principal da aplicação.
     */
    public function up(): void
    {
        DB::statement('CREATE SCHEMA IF NOT EXISTS sintech');
    }

    /**
     * Remove o schema da aplicação.
     */
    public function down(): void
    {
        DB::statement('DROP SCHEMA IF EXISTS sintech CASCADE');
    }
};