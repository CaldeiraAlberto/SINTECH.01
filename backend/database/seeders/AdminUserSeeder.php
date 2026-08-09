<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['numero_cracha' => 'HD000'],
            [
                'name' => 'admin',
                'email' => 'admin@sintech.com',
                'password' => Hash::make('admin'),
                'role' => 'helpdesk',
                'ativo' => true,
            ]
        );

        User::updateOrCreate(
            ['numero_cracha' => 'HD001'],
            [
                'name' => 'Caldeira',
                'email' => 'caldeira@sintech.com',
                'password' => Hash::make('12345'),
                'role' => 'helpdesk',
                'ativo' => true,
            ]
        );

        User::updateOrCreate(
            ['numero_cracha' => 'HD002'],
            [
                'name' => 'Florinel',
                'email' => 'florinel@sintech.com',
                'password' => Hash::make('12345'),
                'role' => 'helpdesk',
                'ativo' => true,
            ]
        );

        User::updateOrCreate(
            ['numero_cracha' => 'HD003'],
            [
                'name' => 'Amandio',
                'email' => 'amandio@sintech.com',
                'password' => Hash::make('12345'),
                'role' => 'helpdesk',
                'ativo' => true,
            ]
        );
    }
}