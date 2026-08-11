<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Inserir Utilizadores
        $users = [
            ['numero_cracha' => 'CR-1001', 'name' => 'Sónia Martins', 'email' => 'sonia.martins@sintech.com', 'role' => 'responsavel', 'ativo' => true],
            ['numero_cracha' => 'CR-1002', 'name' => 'Carlos Silva', 'email' => 'carlos.silva@sintech.com', 'role' => 'helpdesk', 'ativo' => true],
            ['numero_cracha' => 'CR-1003', 'name' => 'Ana Pereira', 'email' => 'ana.pereira@sintech.com', 'role' => 'responsavel', 'ativo' => true],
            ['numero_cracha' => 'CR-1004', 'name' => 'Pedro Santos', 'email' => 'pedro.santos@sintech.com', 'role' => 'helpdesk', 'ativo' => true],
            ['numero_cracha' => 'CR-1005', 'name' => 'Maria Fernandes', 'email' => 'maria.fernandes@sintech.com', 'role' => 'responsavel', 'ativo' => true],
            ['numero_cracha' => 'CR-1006', 'name' => 'João Costa', 'email' => 'joao.costa@sintech.com', 'role' => 'responsavel', 'ativo' => true],
            ['numero_cracha' => 'CR-1007', 'name' => 'Sofia Ribeiro', 'email' => 'sofia.ribeiro@sintech.com', 'role' => 'helpdesk', 'ativo' => true],
            ['numero_cracha' => 'CR-1008', 'name' => 'Miguel Oliveira', 'email' => 'miguel.oliveira@sintech.com', 'role' => 'responsavel', 'ativo' => true],
            ['numero_cracha' => 'CR-1009', 'name' => 'Beatriz Lima', 'email' => 'beatriz.lima@sintech.com', 'role' => 'responsavel', 'ativo' => false],
            ['numero_cracha' => 'CR-1010', 'name' => 'Diogo Martins', 'email' => 'diogo.martins@sintech.com', 'role' => 'helpdesk', 'ativo' => true],
            ['numero_cracha' => 'CR-1011', 'name' => 'Inês Rocha', 'email' => 'ines.rocha@sintech.com', 'role' => 'responsavel', 'ativo' => true],
            ['numero_cracha' => 'CR-1012', 'name' => 'Tiago Alves', 'email' => 'tiago.alves@sintech.com', 'role' => 'responsavel', 'ativo' => true],
            ['numero_cracha' => 'CR-1013', 'name' => 'Mariana Carvalho', 'email' => 'mariana.carvalho@sintech.com', 'role' => 'helpdesk', 'ativo' => true],
            ['numero_cracha' => 'CR-1014', 'name' => 'André Sousa', 'email' => 'andre.sousa@sintech.com', 'role' => 'responsavel', 'ativo' => true],
            ['numero_cracha' => 'CR-1015', 'name' => 'Francisca Correia', 'email' => 'francisca.correia@sintech.com', 'role' => 'responsavel', 'ativo' => false],
            ['numero_cracha' => 'CR-1016', 'name' => 'Gonçalo Pinto', 'email' => 'goncalo.pinto@sintech.com', 'role' => 'helpdesk', 'ativo' => true],
            ['numero_cracha' => 'CR-1017', 'name' => 'Catarina Neves', 'email' => 'catarina.neves@sintech.com', 'role' => 'responsavel', 'ativo' => true],
            ['numero_cracha' => 'CR-1018', 'name' => 'Rodrigo Mendes', 'email' => 'rodrigo.mendes@sintech.com', 'role' => 'responsavel', 'ativo' => true],
            ['numero_cracha' => 'CR-1019', 'name' => 'Alice Ferreira', 'email' => 'alice.ferreira@sintech.com', 'role' => 'helpdesk', 'ativo' => true],
            ['numero_cracha' => 'CR-1020', 'name' => 'Bernardo Ramos', 'email' => 'bernardo.ramos@sintech.com', 'role' => 'responsavel', 'ativo' => true],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                array_merge($user, [
                    'password'   => Hash::make('12345678'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        // 2. Inserir Softwares com 'tipo' alinhado com a constraint CHECK
        $softwares = [
            ['nome' => 'Microsoft Office 365', 'fabricante' => 'Microsoft', 'versao' => '16.0.17328', 'tipo' => 'Aplicação'],
            ['nome' => 'Google Chrome', 'fabricante' => 'Google', 'versao' => '122.0.6261', 'tipo' => 'Aplicação'],
            ['nome' => 'Mozilla Firefox', 'fabricante' => 'Mozilla', 'versao' => '123.0.1', 'tipo' => 'Aplicação'],
            ['nome' => 'Adobe Photoshop 2024', 'fabricante' => 'Adobe', 'versao' => '25.5.1', 'tipo' => 'Aplicação'],
            ['nome' => 'Adobe Acrobat Reader DC', 'fabricante' => 'Adobe', 'versao' => '24.001.20604', 'tipo' => 'Utilitário'],
            ['nome' => 'Visual Studio Code', 'fabricante' => 'Microsoft', 'versao' => '1.87.2', 'tipo' => 'Aplicação'],
            ['nome' => 'AutoCAD 2024', 'fabricante' => 'Autodesk', 'versao' => '24.3.51', 'tipo' => 'Aplicação'],
            ['nome' => 'Zoom Workplace', 'fabricante' => 'Zoom Video Communications', 'versao' => '5.17.11', 'tipo' => 'Aplicação'],
            ['nome' => 'Slack', 'fabricante' => 'Slack Technologies', 'versao' => '4.36.140', 'tipo' => 'Aplicação'],
            ['nome' => 'Kaspersky Endpoint Security', 'fabricante' => 'Kaspersky', 'versao' => '12.5.0', 'tipo' => 'Antivírus'],
            ['nome' => 'WinRAR', 'fabricante' => 'win.rar GmbH', 'versao' => '7.00', 'tipo' => 'Utilitário'],
            ['nome' => '7-Zip', 'fabricante' => 'Igor Pavlov', 'versao' => '23.01', 'tipo' => 'Utilitário'],
            ['nome' => 'Docker Desktop', 'fabricante' => 'Docker Inc.', 'versao' => '4.28.0', 'tipo' => 'Utilitário'],
            ['nome' => 'Postman', 'fabricante' => 'Postman Inc.', 'versao' => '10.23.5', 'tipo' => 'Aplicação'],
            ['nome' => 'Node.js LTS', 'fabricante' => 'OpenJS Foundation', 'versao' => '20.11.1', 'tipo' => 'Utilitário'],
            ['nome' => 'Git for Windows', 'fabricante' => 'Git Development Team', 'versao' => '2.44.0', 'tipo' => 'Utilitário'],
            ['nome' => 'VLC Media Player', 'fabricante' => 'VideoLAN', 'versao' => '3.0.20', 'tipo' => 'Aplicação'],
            ['nome' => 'Notepad++', 'fabricante' => 'Don Ho', 'versao' => '8.6.4', 'tipo' => 'Aplicação'],
            ['nome' => 'Figma Desktop', 'fabricante' => 'Figma Inc.', 'versao' => '116.15.4', 'tipo' => 'Aplicação'],
            ['nome' => 'AnyDesk', 'fabricante' => 'AnyDesk Software', 'versao' => '8.0.8', 'tipo' => 'Utilitário'],
        ];

        foreach ($softwares as $sw) {
            DB::table('softwares')->updateOrInsert(
                ['nome' => $sw['nome'], 'versao' => $sw['versao']],
                array_merge($sw, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }

    public function down(): void
    {
        DB::table('users')->where('email', 'LIKE', '%@sintech.com')->delete();

        DB::table('softwares')->whereIn('nome', [
            'Microsoft Office 365', 'Google Chrome', 'Mozilla Firefox', 'Adobe Photoshop 2024',
            'Adobe Acrobat Reader DC', 'Visual Studio Code', 'AutoCAD 2024', 'Zoom Workplace',
            'Slack', 'Kaspersky Endpoint Security', 'WinRAR', '7-Zip', 'Docker Desktop',
            'Postman', 'Node.js LTS', 'Git for Windows', 'VLC Media Player', 'Notepad++',
            'Figma Desktop', 'AnyDesk'
        ])->delete();
    }
};