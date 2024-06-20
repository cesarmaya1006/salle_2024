<?php

namespace App\Http\Controllers\Propuestas;

use App\Http\Controllers\Controller;
use App\Models\Propuestas\Componente;
use App\Models\Propuestas\SubComponente;
use Illuminate\Http\Request;

class SubComponenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_componentes = SubComponente::get();
        return view('intranet.propuestas.componentes.index', compact('sub_componentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $componentes = Componente::get();
        return view('intranet.propuestas.componentes.crear',compact('componentes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        SubComponente::create($request->all());
        return redirect('dashboard/parametros/subcomponentes')->with('mensaje', 'Componente creada con exito');
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
        $componentes = Componente::get();
        $subcomponente_edit = SubComponente::findOrFail($id);
        return view('intranet.propuestas.componentes.editar', compact('subcomponente_edit','componentes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        SubComponente::findOrFail($id)->update($request->all());
        return redirect('dashboard/parametros/subcomponentes')->with('mensaje', 'Componente actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            if (SubComponente::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
