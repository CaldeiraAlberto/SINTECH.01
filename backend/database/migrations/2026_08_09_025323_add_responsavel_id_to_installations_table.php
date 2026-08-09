<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adiciona o responsável à instalação.
     */
    public function up(): void
    {
        Schema::table('sintech.installations', function (Blueprint $table) {
            $table->foreignId('responsavel_id')
                ->nullable()
                ->after('software_id')
                ->constrained('sintech.users')
                ->nullOnDelete();
        });
    }

    /**
     * Remove o responsável da instalação.
     */
    public function down(): void
    {
        Schema::table('sintech.installations', function (Blueprint $table) {
            $table->dropForeign([
                'responsavel_id'
            ]);

            $table->dropColumn('responsavel_id');
        });
    }
};