<?php

namespace App\Http\Controllers\Propuestas;

use App\Http\Controllers\Controller;
use App\Models\Propuestas\Componente;
use Illuminate\Http\Request;

class ComponenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $componentes = Componente::get();
        return view('intranet.propuestas.categorias.index', compact('componentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('intranet.propuestas.categorias.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Componente::create($request->all());
        return redirect('dashboard/parametros/componentes')->with('mensaje', 'Categoría creada con exito');
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
        $componente_edit = Componente::findOrFail($id);
        return view('intranet.propuestas.categorias.editar', compact('componente_edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Componente::findOrFail($id)->update($request->all());
        return redirect('dashboard/parametros/componentes')->with('mensaje', 'Categoría actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            if (Componente::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }
}
