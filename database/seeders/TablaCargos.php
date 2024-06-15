<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaCargos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('cargos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $datas = [
            [
                'area_id' => 1,
                'cargo' => 'Gerente General',
            ],
            [
                'area_id' => 2,
                'cargo' => 'Director Administrativo',
            ],
            [
                'area_id' => 3,
                'cargo' => 'Director Técnico',
            ],
            [
                'area_id' => 4,
                'cargo' => 'Director Operativo',
            ],
            [
                'area_id' => 4,
                'cargo' => 'Desarrollador',
            ],

            [
                'area_id' => 5,
                'cargo' => 'Gerente General',
            ],
            [
                'area_id' => 6,
                'cargo' => 'Director Administrativo',
            ],
            [
                'area_id' => 7,
                'cargo' => 'Director Técnico',
            ],
            [
                'area_id' => 8,
                'cargo' => 'Director Operativo',
            ],
            [
                'area_id' => 8,
                'cargo' => 'Desarrollador',
            ],

            [
                'area_id' => 9,
                'cargo' => 'Gerente General',
            ],
            [
                'area_id' => 10,
                'cargo' => 'Director Administrativo',
            ],
            [
                'area_id' => 11,
                'cargo' => 'Director Técnico',
            ],
            [
                'area_id' => 12,
                'cargo' => 'Director Operativo',
            ],
            [
                'area_id' => 12,
                'cargo' => 'Desarrollador',
            ],

            [
                'area_id' => 13,
                'cargo' => 'Gerente General',
            ],
            [
                'area_id' => 14,
                'cargo' => 'Director Administrativo',
            ],
            [
                'area_id' => 15,
                'cargo' => 'Director Técnico',
            ],
            [
                'area_id' => 16,
                'cargo' => 'Director Operativo',
            ],
            [
                'area_id' => 16,
                'cargo' => 'Desarrollador',
            ],

            [
                'area_id' => 17,
                'cargo' => 'Gerente General',
            ],
            [
                'area_id' => 18,
                'cargo' => 'Director Administrativo',
            ],
            [
                'area_id' => 19,
                'cargo' => 'Director Técnico',
            ],
            [
                'area_id' => 20,
                'cargo' => 'Director Operativo',
            ],
            [
                'area_id' => 20,
                'cargo' => 'Desarrollador',
            ],

        ];


        foreach ($datas as $data) {
            DB::table('cargos')->insert([
                'area_id' => $data['area_id'],
                'cargo' => $data['cargo'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
