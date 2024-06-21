<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TablaRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // ===================================================================================
        $rol1 = Role::create(['name'=>'Super Administrador']);
        $rol2 = Role::create(['name'=>'Administrador']);
        $rol3 = Role::create(['name'=>'Jurado']);
        $rol4 = Role::create(['name'=>'Emprendedor']);

        Permission::create(['name'=>'dashboard'])->syncRoles([$rol1,$rol2,$rol3,$rol4]);

        Permission::create(['name'=>'menu.index'])->syncRoles([$rol1]);
        Permission::create(['name'=>'rol.index'])->syncRoles([$rol1]);

        Permission::create(['name'=>'menu.rol.index'])->syncRoles([$rol1]);
        Permission::create(['name'=>'menu.rol.store'])->syncRoles([$rol1]);

        Permission::create(['name'=>'permiso_rutas.index'])->syncRoles([$rol1]);

        Permission::create(['name'=>'permisos_rol.index'])->syncRoles([$rol1]);
        Permission::create(['name'=>'permisos_rol.store'])->syncRoles([$rol1]);
        Permission::create(['name'=>'permisos_rol.excepciones'])->syncRoles([$rol1]);
        Permission::create(['name'=>'permisos_rol.store_excepciones'])->syncRoles([$rol1]);

        Permission::create(['name'=>'usuarios.index'])->syncRoles([$rol1]);
        Permission::create(['name'=>'usuarios.create'])->syncRoles([$rol1]);
        Permission::create(['name'=>'usuarios.edit'])->syncRoles([$rol1]);
        Permission::create(['name'=>'usuarios.destroy'])->syncRoles([$rol1]);

        Permission::create(['name'=>'componentes.index'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name'=>'componentes.create'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name'=>'componentes.edit'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name'=>'componentes.destroy'])->syncRoles([$rol1,$rol2]);

        Permission::create(['name'=>'subcomponentes.index'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name'=>'subcomponentes.create'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name'=>'subcomponentes.edit'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name'=>'subcomponentes.destroy'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name'=>'subcomponentes.asignacion'])->syncRoles([$rol1,$rol2]);

        Permission::create(['name'=>'propuestas.index'])->syncRoles([$rol1,$rol2]);
        Permission::create(['name'=>'intranet.propuestas.admin.index'])->syncRoles([$rol1,$rol2]);

        Permission::create(['name'=>'intranet.propuestas.emprendedor.index'])->syncRoles([$rol4]);



    }
}
