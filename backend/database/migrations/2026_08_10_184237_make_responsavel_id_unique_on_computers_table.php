<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sintech.computers', function (Blueprint $table) {
            $table->unique(
                'responsavel_id',
                'computers_responsavel_id_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('sintech.computers', function (Blueprint $table) {
            $table->dropUnique(
                'computers_responsavel_id_unique'
            );
        });
    }
};