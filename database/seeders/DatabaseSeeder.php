<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TablaTiposDocuSeeder::class,
            TablaRolesSeeder::class,
            TablaMenusSeeder::class,
            TablaUsuariosSeeder::class,
            TablaComponenteSeeder::class,
            TablaSubComponenteSeeder::class,
            TablaPropuestasSeeder::class,

        ]);
    }
}
