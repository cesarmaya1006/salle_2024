<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Config\TipoDocumento;
use App\Models\Empresa\EmpGrupo;
use App\Models\Empresa\Empresa;
use Illuminate\Http\Request;

class EmpGrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupos = EmpGrupo::orderBy('id')->get();
        return view('intranet.empresa.grupo.index', compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposdocu = TipoDocumento::get();
        return view('intranet.empresa.grupo.crear',compact('tiposdocu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $empresa= EmpGrupo::create($request->all());
        //$apariencia = ConfigApariencia::findOrfail(1);
        //$apariencia['config_empresa_id'] = $empresa->id;
        //ConfigApariencia::create($apariencia);
        return redirect('dashboard/configuracion_sis/grupo_empresas')->with('mensaje', 'Grupo Empresarial creado con éxito');
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
    public function edit( $id)
    {
        $tiposdocu = TipoDocumento::get();
        $grupo_edit = EmpGrupo::findOrFail($id);
        return view('intranet.empresa.grupo.editar',compact('tiposdocu','grupo_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        EmpGrupo::findOrFail($id)->update($request->all());
        return redirect('dashboard/configuracion_sis/grupo_empresas')->with('mensaje', 'Grupo Empresarial actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $grupo = EmpGrupo::FindOrFail($id);
            if ($grupo->empresas->count()) {
                return response()->json(['mensaje' => 'ng']);
            } else {
                if (EmpGrupo::destroy($id)) {
                    return response()->json(['mensaje' => 'ok']);
                } else {
                    return response()->json(['mensaje' => 'ng']);
                }
            }

        } else {
            abort(404);
        }
    }

    public function activar(Request $request,$id){
        if ($request->ajax()) {
            $cambioEstado['estado'] = $request['data_estado'];
            EmpGrupo::findOrFail($id)->update($cambioEstado);
            if ($request['data_estado'] == 0) {
                return response()->json(['mensaje' => 'Desactivada']);
            } else {
                return response()->json(['mensaje' => 'Activada']);
            }
        } else {
            abort(404);
        }
    }

    public function getEmpresas(Request $request){
        if ($request->ajax()) {
            return response()->json(['empresas' => Empresa::where('config_grupo_empresas_id',$_GET['id'])->get()]);
        } else {
            abort(404);
        }
    }
}
