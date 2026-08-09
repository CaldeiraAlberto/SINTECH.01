<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sintech.softwares', function (Blueprint $table) {

            $table->id();

            $table->string('nome');

            $table->string('versao');

            $table->string('fabricante');

            $table->string('licenca')->nullable();

            $table->enum('tipo', [

                'Sistema Operativo',

                'Aplicação',

                'Antivírus',

                'Driver',

                'Utilitário'

            ]);

            $table->enum('estado', [

                'Ativo',

                'Expirado',

                'Descontinuado'

            ])->default('Ativo');

            $table->text('observacoes')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sintech.softwares');
    }
};
