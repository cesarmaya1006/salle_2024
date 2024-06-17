<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Empresa\EmpGrupo;
use App\Models\Empresa\Empresa;
use Illuminate\Http\Request;

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
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $empresa = Empresa::findOrFail($id);
            if ($empresa->areas->count() > 0) {
                return response()->json(['mensaje' => 'ng']);
            } else {
                if (Empresa::destroy($id)) {
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
