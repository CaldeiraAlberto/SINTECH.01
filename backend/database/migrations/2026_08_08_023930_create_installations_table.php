<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sintech.installations', function (Blueprint $table) {

            $table->id();

            $table->foreignId('computer_id')
                ->constrained('sintech.computers')
                ->cascadeOnDelete();

            $table->foreignId('software_id')
                ->constrained('sintech.softwares')
                ->cascadeOnDelete();

            $table->date('data_instalacao');

            $table->string('instalado_por');

            $table->enum('estado', [

                'Instalado',

                'Atualizado',

                'Removido'

            ])->default('Instalado');

            $table->text('observacoes')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sintech.installations');
    }
};
