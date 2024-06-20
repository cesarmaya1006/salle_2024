<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaComponenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('componentes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // ===================================================================================
        $componentes = [
            'Administrativo',
            'Mercadeo',
            'Financiero',
            'Producción, logística y operaciones',
            'Sostenibilidad',
            'Propuesta de Coofinanciamiento',
        ];

        foreach ($componentes as $key => $value) {
            DB::table('componentes')->insert([
                'componente' => $value,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
