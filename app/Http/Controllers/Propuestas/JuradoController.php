<?php

namespace App\Http\Controllers\Propuestas;

use App\Http\Controllers\Controller;
use App\Models\Config\Persona;
use App\Models\Propuestas\Componente;
use App\Models\Propuestas\PrimFaseComponente;
use App\Models\Propuestas\PrimFaseNota;
use App\Models\Propuestas\Propuesta;
use App\Models\Propuestas\SegFaseComponente;
use App\Models\Propuestas\SegFaseNota;
use App\Models\User;
use Illuminate\Http\Request;

class JuradoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurados = User::with('persona.propuestas_j')->role('Jurado')->get();
        return view('intranet.propuestas.jurados.index',compact('jurados'));
    }

    public function asignacion()
    {

        $jurados = User::with('persona.propuestas_j')->role('Jurado')->get();
        $propuestas = Propuesta::get();
        return view('intranet.propuestas.jurados.asignacion',compact('jurados','propuestas'));
    }


    public function asignacion_dos()
    {
        $jurados = User::with('persona.propuestas_j')->role('Jurado')->get();
        $propuestas = Propuesta::where('estado',4)->orderBy('promedio_primera','desc')->take(30)->get();
        return view('intranet.propuestas.jurados.asignacion_dos',compact('jurados','propuestas'));
    }

    public function calificar_primera_fase($id){
        $propuesta = Propuesta::findOrFail($id);
        $componentes = Componente::get();
        return view('intranet.propuestas.jurados.calif_prim_fase',compact('propuesta','componentes'));
    }

    public function calificar_primera_fase_guardar(Request $request,$id){
        if ($request->ajax()) {
            $componente_primera_fase = PrimFaseComponente::findOrFail($id);
            $propuesta = Propuesta::findOrfail($componente_primera_fase->propuestas_id);
            //=====================================================================================
            $nuevaNota['prim_fase_componentes_id'] = $id;
            $nuevaNota['personas_id'] = session('id_usuario');
            $nuevaNota['calificacion'] = $request['calificacion'];
            if ($request['observacion']!=null) {
                $nuevaNota['observacion'] = $request['observacion'];
            }
            $nota =PrimFaseNota::create($nuevaNota);
            $observacion = $nota->observacion;
            $nota = $nota->calificacion;
            //=====================================================================================
            $sumNotasPrimFaseComp = $componente_primera_fase->notas->sum('calificacion');
            $cantJurados = $propuesta->jurados->count();
            $promedioComponente['not_promedio'] = $sumNotasPrimFaseComp/$cantJurados;
            PrimFaseComponente::findOrFail($id)->update($promedioComponente);
            //=====================================================================================
            $componentes = Componente::get();
            $sumComponente=[];
            $i=0;
            foreach ($componentes as $componente) {
                $i++;
                foreach ($componente_primera_fase->propuesta->componentesFaseUno as $compoPrimera) {
                   if ($componente->id == $compoPrimera->subcomponente->componente_id) {
                    $sumComponente[$i][] = $compoPrimera->not_promedio;
                   }
                }
            }
            $notaFinal=0;
            foreach ($sumComponente as $compo) {
                $notaFinal += array_sum($compo)/count($compo);
            }
            $finalPromedio = $notaFinal/$componentes->count();
            $propuestaUpdate['promedio_primera'] = $finalPromedio;
            //------------------------------------------------------------------------------------------
            $cantSubComponentes = 0;
            foreach ($componentes as $componente) {
                $cantSubComponentes+= $componente->sub_componentes->count();
            }
            $cantJurados = $propuesta->jurados->count();
            $cantNotasCalificadas =0;
            foreach ($propuesta->componentesFaseUno as $componenteFaseUno) {
                $cantNotasCalificadas+= $componenteFaseUno->notas->count();
            }
            if ($cantNotasCalificadas==($cantSubComponentes*$cantJurados)) {
                $propuestaUpdate['estado'] = 4;
            }else{
                $propuestaUpdate['estado'] = 3;
            }
            //------------------------------------------------------------------------------------------
            Propuesta::findOrFail($propuesta->id)->update($propuestaUpdate);
            $resp = 'Propuesta calificada con exito';
            return response()->json(['mensaje' => 'ok','propuesta' => $propuesta,'id'=>$id,'resp'=>$resp,'observacion'=>$observacion,'nota'=>$nota]);
        } else {
            abort(404);
        }
    }

    public function calificar_segunda_fase($id){
        $propuesta = Propuesta::findOrFail($id);
        $componentes = Componente::get();
        return view('intranet.propuestas.jurados.calif_seg_fase',compact('propuesta','componentes'));
    }

    public function calificar_segunda_fase_guardar(Request $request,$id){
        if ($request->ajax()) {
            $componente_segunda_fase = SegFaseComponente::findOrFail($id);
            $propuesta = Propuesta::findOrfail($componente_segunda_fase->propuestas_id);
            //=====================================================================================
            $nuevaNota['seg_fase_componentes_id'] = $id;
            $nuevaNota['personas_id'] = session('id_usuario');
            $nuevaNota['calificacion'] = $request['calificacion'];
            if ($request['observacion']!=null) {
                $nuevaNota['observacion'] = $request['observacion'];
            }
            $nota =SegFaseNota::create($nuevaNota);
            $observacion = $nota->observacion;
            $nota = $nota->calificacion;
            //=====================================================================================
            $sumNotasPrimFaseComp = $componente_segunda_fase->notas->sum('calificacion');
            $cantJurados = $propuesta->jurados_dos->count();
            $promedioComponente['not_promedio'] = $sumNotasPrimFaseComp/$cantJurados;
            SegFaseComponente::findOrFail($id)->update($promedioComponente);
            //=====================================================================================
            $propuestaUpdate['promedio_segunda'] = $propuesta->componentesFaseDos->sum('not_promedio')/$propuesta->componentesFaseDos->count();
            $cantNotasCalificadas = 0;
            foreach ($propuesta->componentesFaseDos as $componenteFaseDos) {
                foreach ($componenteFaseDos->notas as $nota) {
                    $cantNotasCalificadas++;
                }
            }
            if ($cantNotasCalificadas==($propuesta->componentesFaseDos->count()*$cantJurados)) {
                $propuestaUpdate['estado'] = 6;
            }else{
                $propuestaUpdate['estado'] = 5;
            }
            //------------------------------------------------------------------------------------------
            Propuesta::findOrFail($propuesta->id)->update($propuestaUpdate);
            $resp = 'Componente calificada con exito';
            return response()->json(['mensaje' => 'ok','propuesta' => $propuesta,'id'=>$id,'resp'=>$resp,'observacion'=>$request['observacion'],'nota'=>$request['calificacion']]);
        } else {
            abort(404);
        }
    }
}
