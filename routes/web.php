<?php

use App\Http\Controllers\Config\MenuController;
use App\Http\Controllers\Config\MenuRolController;
use App\Http\Controllers\Config\PageController;
use App\Http\Controllers\Config\PermisoController;
use App\Http\Controllers\Config\PermisoRolController;
use App\Http\Controllers\Config\RolController;
use App\Http\Controllers\Propuestas\ComponenteController;
use App\Http\Controllers\Propuestas\EmprendedorController;
use App\Http\Controllers\Propuestas\JuradoController;
use App\Http\Controllers\Propuestas\PropuestaController;
use App\Http\Controllers\Propuestas\SubComponenteController;
use App\Http\Controllers\Usuarios\UsuarioController;
use App\Http\Middleware\AdminSis;
use App\Http\Middleware\Emprendedor;
use App\Http\Middleware\Jurado;
use App\Http\Middleware\SuperAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('dashboard')->middleware(['auth:sanctum', config('jetstream.auth_session'),])->group(function () {
    Route::get('', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [PageController::class, 'profile'])->name('profile');
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    //Middleware Super admin
    Route::prefix('configuracion_sis')->middleware(SuperAdmin::class)->group(function () {
        // Ruta Administrador del Sistema Menus
        // ------------------------------------------------------------------------------------
        Route::controller(MenuController::class)->prefix('menu')->group(function () {
            Route::get('', 'index')->name('menu.index');
            Route::get('crear', 'create')->name('menu.create');
            Route::get('editar/{id}', 'edit')->name('menu.edit');
            Route::post('guardar', 'store')->name('menu.store');
            Route::put('actualizar/{id}', 'update')->name('menu.update');
            Route::get('eliminar/{id}', 'destroy')->name('menu.destroy');
            Route::get('guardar-orden', 'guardarOrden')->name('menu.ordenar');
        });
        // ------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Roles
        Route::controller(RolController::class)->prefix('rol')->group(function () {
            Route::get('', 'index')->name('rol.index');
            Route::get('crear', 'create')->name('rol.create');
            Route::get('editar/{id}', 'edit')->name('rol.edit');
            Route::post('guardar', 'store')->name('rol.store');
            Route::put('actualizar/{id}', 'update')->name('rol.update');
            Route::delete('eliminar/{id}', 'destroy')->name('rol.destroy');
        });
        // ----------------------------------------------------------------------------------------
        /* Ruta Administrador del Sistema Menu Rol*/
        Route::controller(MenuRolController::class)->prefix('permisos_menus_rol')->group(function () {
            Route::get('', 'index')->name('menu.rol.index');
            Route::post('guardar', 'store')->name('menu.rol.store');
        });
        // ------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Roles
        Route::controller(PermisoController::class)->prefix('permiso_rutas')->group(function () {
            Route::get('', 'index')->name('permiso_rutas.index');
        });
        // ----------------------------------------------------------------------------------------
        /* Ruta Administrador del Sistema Menu Rol*/
        Route::controller(PermisoRolController::class)->prefix('permisos_rol')->group(function () {
            Route::get('', 'index')->name('permisos_rol.index');
            Route::post('guardar', 'store')->name('permisos_rol.store');
            Route::get('excepciones/{permission_id}/{role_id}', 'excepciones')->name('permisos_rol.excepciones');
            Route::post('guardar_excepciones', 'store_excepciones')->name('permisos_rol.store_excepciones');
        });
        // ----------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Roles
        Route::controller(UsuarioController::class)->prefix('usuarios')->group(function () {
            Route::get('', 'index')->name('usuarios.index');
            Route::get('crear', 'create')->name('usuarios.create');
            Route::get('editar/{id}', 'edit')->name('usuarios.edit');
            Route::post('guardar', 'store')->name('usuarios.store');
            Route::put('actualizar/{id}', 'update')->name('usuarios.update');
            Route::delete('eliminar/{id}', 'destroy')->name('usuarios.destroy');
        });
        // ----------------------------------------------------------------------------------------

    });
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    Route::middleware(AdminSis::class)->group(function () {
        Route::get('refrescar_notas', [PropuestaController::class,'refrescar_notas',])->name('refrescar.notas');
        Route::prefix('parametros')->group(function () {
            // ----------------------------------------------------------------------------------------
            // Ruta Administrador del Sistema Roles
            Route::controller(ComponenteController::class)->prefix('componentes')->group(function () {
                Route::get('', 'index')->name('componentes.index');
                Route::get('crear', 'create')->name('componentes.create');
                Route::get('editar/{id}', 'edit')->name('componentes.edit');
                Route::post('guardar', 'store')->name('componentes.store');
                Route::put('actualizar/{id}', 'update')->name('componentes.update');
                Route::delete('eliminar/{id}', 'destroy')->name('componentes.destroy');
            });
            // ----------------------------------------------------------------------------------------
            // Ruta Administrador del Sistema Roles
            Route::controller(SubComponenteController::class)->prefix('subcomponentes')->group(function () {
                Route::get('', 'index')->name('subcomponentes.index');
                Route::get('crear', 'create')->name('subcomponentes.create');
                Route::get('editar/{id}', 'edit')->name('subcomponentes.edit');
                Route::post('guardar', 'store')->name('subcomponentes.store');
                Route::put('actualizar/{id}', 'update')->name('subcomponentes.update');
                Route::delete('eliminar/{id}', 'destroy')->name('subcomponentes.destroy');
            });
        });
        // ----------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Roles
        Route::controller(JuradoController::class)->prefix('jurados')->group(function () {
            Route::get('', 'index')->name('jurados.index');
            Route::get('crear', 'create')->name('jurados.create');
            Route::get('editar/{id}', 'edit')->name('jurados.edit');
            Route::post('guardar', 'store')->name('jurados.store');
            Route::put('actualizar/{id}', 'update')->name('jurados.update');
            Route::delete('eliminar/{id}', 'destroy')->name('jurados.destroy');
            Route::get('asignacion', 'asignacion')->name('jurados.asignacion');
            Route::get('asignacion_dos', 'asignacion_dos')->name('jurados.asignacion_dos');
        });
        // ----------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Roles
        Route::controller(EmprendedorController::class)->prefix('emprendedores')->group(function () {
            Route::get('', 'index')->name('emprendedores.index');
        });
        // ----------------------------------------------------------------------------------------
        Route::controller(PropuestaController::class)->group(function (){
            Route::prefix('propuestas')->group(function(){
                Route::get('asignar','asignar')->name('propuestas.asignar');
                Route::post('asignar_guardar','asignar_guardar')->name('propuestas.asignar_guardar');
                Route::get('asignar_dos','asignar_dos')->name('propuestas.asignar_dos');
                Route::post('asignar_guardar_dos','asignar_guardar_dos')->name('propuestas.asignar_guardar_dos');

            });
        });
        // ----------------------------------------------------------------------------------------
        Route::get('exportar_notas/{id}', [PropuestaController::class,'exportar_notas',])->name('exportar_notas');
        Route::get('exportar_notas_dos/{id}', [PropuestaController::class,'exportar_notas_dos',])->name('exportar_notas_dos');
    });
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    Route::middleware(Jurado::class)->group(function () {
        // ----------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Roles
        Route::controller(JuradoController::class)->group(function () {
            Route::get('calificar-primera-fase/{id}', 'calificar_primera_fase')->name('jurados.calificar_primera_fase');
            Route::post('calificar-primera-fase/{id}/guardar', 'calificar_primera_fase_guardar')->name('jurados.calificar_primera_fase_guardar');

            Route::get('calificar-segunda-fase/{id}', 'calificar_segunda_fase')->name('jurados.calificar_segunda_fase');
            Route::post('calificar-segunda-fase/{id}/guardar', 'calificar_segunda_fase_guardar')->name('jurados.calificar_segunda_fase_guardar');
        });
        // ----------------------------------------------------------------------------------------
    });
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    // ------------------------------------------------------------------------------------
    Route::prefix('propuestas')->group(function () {
        Route::controller(PropuestaController::class)->group(function(){
            //Propuestas index
            // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
            Route::get('', 'index')->name('propuestas.index');
            Route::get('crear', 'crear')->name('propuestas.crear');
            Route::get('index', 'propuestas')->name('propuestas.propuestas');
            Route::get('propuestas-ver/{id}', 'propuestas_ver')->name('propuestas.propuestas_ver');

            // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
        });
    });
    //-----------------------------------------------------------------------------------------------------
    Route::prefix('propuestas')->group(function () {
        Route::controller(PropuestaController::class)->group(function(){
            // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
            Route::post('guardar', 'guardar')->name('propuestas.guardar');

            // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
        });
    });
});
