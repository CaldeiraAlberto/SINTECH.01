<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sintech.retirements', function (Blueprint $table) {

            $table->id();

            $table->foreignId('computer_id')
                ->constrained('sintech.computers')
                ->cascadeOnDelete();

            $table->date('data_aposentacao');

            $table->string('motivo', 255);

            $table->text('observacoes')->nullable();

            $table->timestamps();

            /*
             * Um computador não deve possuir
             * duas aposentações simultaneamente.
             */
            $table->unique('computer_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sintech.retirements');
    }
};