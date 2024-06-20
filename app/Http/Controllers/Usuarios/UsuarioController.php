<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\Config\Persona;
use App\Models\Config\TipoDocumento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Role;
use Intervention\Image\Laravel\Facades\Image;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::where('id','>',2)->get();
        return view('intranet.usuario.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposdocu = TipoDocumento::get();
        $roles = Role::where('id','>',2)->get();
        return view('intranet.usuario.crear',compact('roles','tiposdocu'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('foto')) {
            $ruta = Config::get('constantes.folder_img_usuarios');
            $ruta = trim($ruta);

            $logo = $request->logo;
            $imagen_logo = Image::read($logo);
            $nombrelogo = time() . $logo->getClientOriginalName();
            $imagen_logo->resize(500, 500);
            $imagen_logo->save($ruta . $nombrelogo, 100);
            $fotoPersona = $nombrelogo;
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $user = User::create([
            'name' => $request['nombre1'].' '.$request['apellido1'],
            'username' => $request['nombre1'].'.'.$request['apellido1'],
            'email' => $request['email'],
            'password' => bcrypt($request['identificacion']),
        ])->assignRole($request['email']);

        Persona::create([
            'id' => $user->id,
            'docutipos_id' => $request['docutipos_id'],
            'identificacion' => $request['identificacion'],
            'nombre1' => $request['nombre1'],
            'nombre2' => $request['nombre2'],
            'apellido1' => $request['apellido1'],
            'apellido2' => $request['apellido2'],
            'telefono' => $request['telefono'],
            'direccion' => $request['direccion'],
            'email' => $request['email'],
            'foto' => $fotoPersona,
            'ups' => $request['identificacion'],

        ]);
        return redirect('dashboard/configuracion_sis/usuarios')->with('mensaje', 'Usuario creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario_edit = User::findOrFail($id);
        $tiposdocu = TipoDocumento::get();
        $roles = Role::where('id','>',2)->get();
        return view('intranet.usuario.editar',compact('roles','tiposdocu','usuario_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user_old = User::findOrFail($id);
        $fotoPersona = $user_old->persona->foto;
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('foto')) {
            $ruta = Config::get('constantes.folder_img_empresas');
            $ruta = trim($ruta);
            unlink($ruta . $user_old->persona->foto);
            $logo = $request->logo;
            $imagen_logo = Image::read($logo);
            $nombrelogo = time() . $logo->getClientOriginalName();
            $imagen_logo->resize(500, 500);
            $imagen_logo->save($ruta . $nombrelogo, 100);
            $fotoPersona = $nombrelogo;
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $user_old->update([
            'name' => $request['nombre1'].' '.$request['apellido1'],
            'username' => $request['nombre1'].'.'.$request['apellido1'],
        ]);

        $user_old->persona->update([
            'nombre1' => $request['nombre1'],
            'nombre2' => $request['nombre2'],
            'apellido1' => $request['apellido1'],
            'apellido2' => $request['apellido2'],
            'telefono' => $request['telefono'],
            'direccion' => $request['direccion'],
            'foto' => $fotoPersona,

        ]);
        return redirect('dashboard/configuracion_sis/usuarios')->with('mensaje', 'Usuario creado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
