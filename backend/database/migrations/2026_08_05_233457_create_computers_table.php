<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sintech.computers', function (Blueprint $table) {

            $table->id();

            $table->string('plaqueta')->unique();

            $table->string('modelo_cpu');

            $table->integer('memoria_gb');

            $table->date('data_entrada');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sintech.computers');
    }
};
