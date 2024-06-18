<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Empresa\Area;
use App\Models\Empresa\EmpGrupo;
use App\Models\User;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = User::with('roles')->findOrFail(session('id_usuario'));
        $roles = collect($usuario->roles);
        $grupos = EmpGrupo::get();
        $areas = Area::get();
        if ($usuario->hasRole('Super Administrador')) {
            return view('intranet.empresa.area.index_admin', compact('grupos'));
        } else {
            $areas = $usuario->empleado->cargo->area->empresa->areas;
            return view('intranet.empresa.area.index', compact('areas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getDependencias(Request $request,$id){
        if ($request->ajax()) {
            return response()->json(['dependencias' => Area::where('area_id',$id)->get()]);
        } else {
            abort(404);
        }
    }
    public function getAreas(Request $request){
        if ($request->ajax()) {
            return response()->json(['areasPadre' => Area::with('area_sup')->with('areas')->where('empresa_id',$_GET['id'])->get()]);
        } else {
            abort(404);
        }
    }
}
