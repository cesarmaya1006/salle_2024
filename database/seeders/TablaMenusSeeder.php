<?php

namespace Database\Seeders;

use App\Models\Config\Menu;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaMenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('menus')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('menu_rol')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');


        // ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ==========
        $menus = [
            //Menu Inicio
            ['nombre' => 'Dashboard', 'menu_id' => null, 'url' => 'dashboard', 'orden' => '1', 'icono' => 'mdi mdi-view-dashboard', 'Array_1' => []],
            //Menu configuración 2
            [
                'nombre' => 'Configuración Sistema', 'menu_id' => null, 'url' => '#', 'orden' => '2', 'icono' => 'fas fa-tools',
                'Array_1' => [
                    //Menu menu
                    ['nombre' => 'Menús', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/menu', 'orden' => '1',  'icono' => 'fas fa-list-ul', 'Array_1' => []],
                    //Menu Roles
                    ['nombre' => 'Roles', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/rol', 'orden' => '2',  'icono' => 'fas fa-users', 'Array_1' => []],
                    //Menu Menu_Roles
                    ['nombre' => 'Menú - Roles', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/permisos_menus_rol', 'orden' => '2',  'icono' => 'fas fa-chalkboard-teacher', 'Array_1' => []],
                    //Menu permisos
                    ['nombre' => 'Permisos', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/permiso_rutas', 'orden' => '2',  'icono' => 'fas fa-check-square', 'Array_1' => []],
                    //Menu permisos-rol
                    ['nombre' => 'Permisos - Roles', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/permisos_rol', 'orden' => '2',  'icono' => 'fas fa-user-shield', 'Array_1' => []],
                    //Menu permisos-rol
                    ['nombre' => 'Usuarios', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/usuarios', 'orden' => '2',  'icono' => 'fas fa-user-friends', 'Array_1' => []],
                ],
            ],
            //Menu parametros
            [
                'nombre' => 'Parametros', 'menu_id' => null, 'url' => '#', 'orden' => '2', 'icono' => 'fas fa-cogs',
                'Array_1' => [
                    //Categorias Componente
                    ['nombre' => 'Categorias Componente', 'menu_id' => '2',  'url' => 'dashboard/parametros/componentes', 'orden' => '1',  'icono' => 'fas fa-sitemap', 'Array_1' => []],
                    //Menu Roles
                    ['nombre' => 'Componentes', 'menu_id' => '2',  'url' => 'dashboard/parametros/subcomponentes', 'orden' => '2',  'icono' => 'fas fa-sort-alpha-down', 'Array_1' => []],
                ],
            ],
            //Menu Propuestas
            ['nombre' => 'Propuestas', 'menu_id' => null, 'url' => 'dashboard/propuestas', 'orden' => '1', 'icono' => 'fas fa-folder-open', 'Array_1' => []],
            //Menu Propuestas Fase Dos
            ['nombre' => 'Propuestas Fase Dos', 'menu_id' => null, 'url' => 'dashboard/fase_dos_propuestas', 'orden' => '1', 'icono' => 'fas fa-folder-open', 'Array_1' => []],
            //Menu Jurados
            ['nombre' => 'Jurados', 'menu_id' => null, 'url' => 'dashboard/jurados', 'orden' => '1', 'icono' => 'fas fa-graduation-cap', 'Array_1' => []],
            //Menu Emprendedores
            ['nombre' => 'Emprendedores', 'menu_id' => null, 'url' => 'dashboard/emprendedores', 'orden' => '1', 'icono' => 'fas fa-user-graduate', 'Array_1' => []],
            //Menu otras opciones
            [
                'nombre' => 'Otras opciones', 'menu_id' => null, 'url' => '#', 'orden' => '2', 'icono' => 'fas fa-question-circle',
                'Array_1' => [
                    //Categorias Componente
                    ['nombre' => 'Consulte nuestas políticas de datos', 'menu_id' => '2',  'url' => 'dashboard/opciones/consulta-politicas', 'orden' => '1',  'icono' => 'fas fa-question-circle', 'Array_1' => []],
                    //Menu Roles
                    ['nombre' => 'Ayuda', 'menu_id' => '2',  'url' => 'dashboard/opciones/ayuda', 'orden' => '2',  'icono' => 'fas fa-question-circle', 'Array_1' => []],
                    //Categorias Componente
                    ['nombre' => 'Actualizar datos', 'menu_id' => '2',  'url' => 'dashboard/opciones/actualizar-datos', 'orden' => '1',  'icono' => 'fas fa-edit', 'Array_1' => []],
                    //Menu Roles
                    ['nombre' => 'Cambiar contraseña', 'menu_id' => '2',  'url' => 'dashboard/opciones/cambiar-password', 'orden' => '2',  'icono' => 'fas fa-key', 'Array_1' => []],
                ],
            ],
        ];
        // ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ==========
        $x = 0;
        foreach ($menus as $menu) {
            $x++;
            $menu_new = Menu::create([
                'menu_id' => $menu['menu_id'],
                'nombre' => utf8_encode(utf8_decode($menu['nombre'])),
                'url' => $menu['url'],
                'orden' => $x,
                'icono' => $menu['icono'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            if (count($menu['Array_1']) > 0) {
                $this->sub_menu($menu['Array_1'], $menu_new->id);
            }
        }
        // ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ==========
        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
        $menus = Menu::get();
        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
        foreach ($menus as $menu) {
            DB::table('menu_rol')->insert(['menu_id' => $menu->id, 'rol_id' => 1,]);
        }
        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
        DB::table('menu_rol')->insert(['menu_id' => 1, 'rol_id' => 2,]);
        for ($i = 9; $i < 12; $i++) {
            DB::table('menu_rol')->insert(['menu_id' => $i, 'rol_id' => 2,]);
        }
        DB::table('menu_rol')->insert(['menu_id' => 14, 'rol_id' => 2,]);
        DB::table('menu_rol')->insert(['menu_id' => 15, 'rol_id' => 2,]);
        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
        DB::table('menu_rol')->insert(['menu_id' => 1, 'rol_id' => 3,]);
        DB::table('menu_rol')->insert(['menu_id' => 12, 'rol_id' => 3,]);
        DB::table('menu_rol')->insert(['menu_id' => 13, 'rol_id' => 3,]);
        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
        DB::table('menu_rol')->insert(['menu_id' => 1, 'rol_id' => 4,]);
        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
    }
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    public function sub_menu($Array_1, $x)
    {
        $y = 0;
        foreach ($Array_1 as $sub_menu_array) {
            $y++;
            $sub_menu = Menu::create([
                'menu_id' => $x,
                'nombre' => utf8_encode(utf8_decode($sub_menu_array['nombre'])),
                'url' => $sub_menu_array['url'],
                'orden' => $y,
                'icono' => $sub_menu_array['icono'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            if (count($sub_menu_array['Array_1']) > 0) {
                $this->sub_menu($sub_menu_array['Array_1'], $sub_menu->id);
            }
        }
    }
}
