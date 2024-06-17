<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Config\TipoDocumento;
use App\Models\Empresa\EmpGrupo;
use App\Models\Empresa\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Laravel\Facades\Image;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupos = EmpGrupo::get();
        return view('intranet.empresa.empresa.index', compact('grupos'));
    }

    public function getEmpresas(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(['data' => Empresa::where('emp_grupo_id', $_GET['id'])->get()]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposdocu = TipoDocumento::get();
        $grupos = EmpGrupo::get();
        return view('intranet.empresa.empresa.crear',compact('tiposdocu','grupos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('logo')) {
            $ruta = Config::get('constantes.folder_img_empresas');
            $ruta = trim($ruta);

            $logo = $request->logo;
            $imagen_logo = Image::read($logo);
            $nombrelogo = time() . $logo->getClientOriginalName();
            $imagen_logo->resize(500, 500);
            $imagen_logo->save($ruta . $nombrelogo, 100);
            $empresa_new['logo'] = $nombrelogo;
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $empresa_new['emp_grupo_id'] = $request['emp_grupo_id'];
        $empresa_new['tipo_documento_id'] = $request['tipo_documento_id'];
        $empresa_new['identificacion'] = $request['identificacion'];
        $empresa_new['empresa'] = ucwords(strtolower($request['empresa']));
        $empresa_new['email'] = strtolower($request['email']);
        $empresa_new['telefono'] = $request['telefono'];
        $empresa_new['direccion'] = $request['direccion'];
        $empresa_new['contacto'] = ucwords(strtolower($request['contacto']));
        $empresa_new['cargo'] = ucwords(strtolower($request['cargo']));
        $empresa = Empresa::create($empresa_new);
        return redirect('dashboard/configuracion_sis/empresas')->with('mensaje', 'Empresa creada con éxito');

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
        $tiposdocu = TipoDocumento::get();
        $grupos = EmpGrupo::get();
        $empresa_edit = Empresa::findOrFail($id);
        return view('intranet.empresa.empresa.editar',compact('tiposdocu','grupos','empresa_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $empresa_old = Empresa::findOrFail($id);
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('logo')) {
            $ruta = Config::get('constantes.folder_img_empresas');
            $ruta = trim($ruta);
            unlink($ruta . $empresa_old->logo);
            $logo = $request->logo;
            $imagen_logo = Image::read($logo);
            $nombrelogo = time() . $logo->getClientOriginalName();
            $imagen_logo->resize(500, 500);
            $imagen_logo->save($ruta . $nombrelogo, 100);
            $empresa_update['logo'] = $nombrelogo;
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        $empresa_update['emp_grupo_id'] = $request['emp_grupo_id'];
        $empresa_update['tipo_documento_id'] = $request['tipo_documento_id'];
        $empresa_update['identificacion'] = $request['identificacion'];
        $empresa_update['empresa'] = ucwords(strtolower($request['empresa']));
        $empresa_update['email'] = strtolower($request['email']);
        $empresa_update['telefono'] = $request['telefono'];
        $empresa_update['direccion'] = $request['direccion'];
        $empresa_update['contacto'] = ucwords(strtolower($request['contacto']));
        $empresa_update['cargo'] = ucwords(strtolower($request['cargo']));
        $empresa_old->update($empresa_update);
        return redirect('dashboard/configuracion_sis/empresas')->with('mensaje', 'Empresa actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $empresa = Empresa::findOrFail($id);
            if ($empresa->areas->count() > 0) {
                return response()->json(['mensaje' => 'ng']);
            } else {
                if (Empresa::destroy($id)) {
                    $ruta = Config::get('constantes.folder_img_empresas');
                    $ruta = trim($ruta);
                    unlink($ruta . $empresa->logo);
                    return response()->json(['mensaje' => 'ok']);
                } else {
                    return response()->json(['mensaje' => 'ng']);
                }
            }
        } else {
            abort(404);
        }
    }
}
