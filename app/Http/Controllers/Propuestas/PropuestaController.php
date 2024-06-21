<?php

namespace App\Http\Controllers\Propuestas;

use App\Http\Controllers\Controller;
use App\Models\Config\Persona;
use App\Models\Propuestas\Componente;
use App\Models\Propuestas\Documento;
use App\Models\Propuestas\Foto;
use App\Models\Propuestas\PrimFaseComponente;
use App\Models\Propuestas\Propuesta;
use App\Models\Propuestas\SubComponente;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Laravel\Facades\Image;

class PropuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propuestas = Propuesta::get();
        foreach ($propuestas as $propuesta) {
            switch ($propuesta->estado) {
                case 1:
                    $propuesta['estado_str'] = 'Sin registro completo';
                    break;
                case 2:
                    $propuesta['estado_str'] = 'Registrada sin calificaciones';
                    break;

                case 3:
                    $propuesta['estado_str'] = 'Con calificación 1era fase incompleta';
                    break;

                case 4:
                    $propuesta['estado_str'] = 'Con calificación 1era fase completa';
                    break;

                case 5:
                    $propuesta['estado_str'] = 'Con calificación 2da fase incompleta';
                    break;
                default:
                    $propuesta['estado_str'] = 'Con calificación 2da fase completa';
                break;
            }
        }


        $jurados = Persona::with('usuario')->with('usuario.roles')->whereHas("usuario.roles", function($q){
            $q->where("name", "Jurado"); })
            ->get();
        $emprendedores = Persona::with('usuario')->with('usuario.roles')->whereHas("usuario.roles", function($q){
            $q->where("name", "Emprendedor"); })
            ->get();
            return view('intranet.propuestas.propuesta.index',compact('propuestas','jurados','emprendedores'));

    }

    public function propuestas()
    {
        $usuario = User::findOrFail(session('id_usuario'));
        if ($usuario->hasAnyRole(['Super Administrador','Administrador'])) {
            $propuestas = Propuesta::get();
        } elseif($usuario->hasRoleTo('Jurado')) {
            $propuestas = Propuesta::whereHas('jurados', function ($q) {
                $q->where('id', session('rol_id'));
            })->get();
        }else{
            $propuestas = Propuesta::where('personas_id',session('rol_id'))->get();
        }
        foreach ($propuestas as $propuesta) {
            switch ($propuesta->estado) {
                case 1:
                    $propuesta['estado_str'] = 'Sin registro completo';
                    $propuesta['barra_progreso'] = '<div class="progress"><div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    break;
                case 2:
                    $propuesta['estado_str'] = 'Registrada sin calificaciones';
                    $propuesta['barra_progreso'] = '<div class="progress"><div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    break;

                case 3:
                    $propuesta['estado_str'] = 'Con calificación 1era fase incompleta';
                    $propuesta['barra_progreso'] = '<div class="progress"><div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    break;

                case 4:
                    $propuesta['estado_str'] = 'Con calificación 1era fase completa';
                    $propuesta['barra_progreso'] = '<div class="progress"><div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    break;

                case 5:
                    $propuesta['estado_str'] = 'Con calificación 2da fase incompleta';
                    $propuesta['barra_progreso'] = '<div class="progress"><div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                    break;
                default:
                    $propuesta['estado_str'] = 'Con calificación 2da fase completa';
                    $propuesta['barra_progreso'] = '<div class="progress"><div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>';
                break;
            }

        }
        return view('intranet.propuestas.admin.propuestas.index',compact('propuestas'));

    }

    public function propuestas_ver($id)
    {
        $componentes = Componente::get();
        $propuesta = Propuesta::findOrFail($id);
        switch ($propuesta->estado) {
            case 1:
                $propuesta['estado_str'] = 'Registrada sin calificaciones';
                break;

            case 2:
                $propuesta['estado_str'] = 'Con calificación 1era fase incompleta';
                break;

            case 3:
                $propuesta['estado_str'] = 'Con calificación 1era fase completa';
                break;

            case 4:
                $propuesta['estado_str'] = 'Con calificación 2da fase incompleta';
                break;
            default:
                $propuesta['estado_str'] = 'Con calificación 2da fase completa';
            break;
        }
        return view('intranet.propuestas.admin.propuestas.ver',compact('propuesta','componentes'));
    }

    public function asignar($id)
    {
        $jurados = Persona::with('usuario')->with('usuario.roles')->whereHas('usuario.roles', function ($q) {
            $q->where('rol_id', 3);
        })->get();
        $propuesta = Propuesta::findOrFail($id);
        return view('intranet.propuestas.admin.propuestas.asignacion_jurados',compact('propuesta','jurados'));
    }

    public function asignar_guardar(Request $request,$persona_id,$propuesta_id)
    {
        if ($request->ajax()) {
            $propuestas = new Propuesta();
            if ($request->input('valor') == 1) {
                $propuestas->find($propuesta_id)->jurados()->attach($persona_id);
                return response()->json(['mensaje' => 'ok']);
            } else {
                $propuestas->find($propuesta_id)->jurados()->detach($persona_id);
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }

    public function asignar_dos($id)
    {
        $jurados = Persona::with('usuario')->with('usuario.roles')->whereHas('usuario.roles', function ($q) {
            $q->where('id', 3);
        })->get();
        $propuesta = Propuesta::findOrFail($id);
        return view('intranet.propuestas.admin.propuestas.asignacion_jurados_dos',compact('propuesta','jurados'));
    }



    public function asignar_guardar_dos(Request $request,$persona_id,$propuesta_id)
    {
        if ($request->ajax()) {
            $propuestas = new Propuesta();
            if ($request->input('valor') == 1) {
                $propuestas->find($propuesta_id)->jurados_dos()->attach($persona_id);
                return response()->json(['mensaje' => 'ok']);
            } else {
                $propuestas->find($propuesta_id)->jurados_dos()->detach($persona_id);
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
    }

    public function exportar_notas($id)
    {
        $propuesta = Propuesta::findOrFail($id);
        $componentes = Componente::get();
        $notas=[];
        foreach ($componentes as $componente) {
            $nota_componente =0;
            foreach ($propuesta->componentesFaseUno as $componenteFaseUno) {
                if ($componenteFaseUno->subcomponente->componente_id == $componente->id) {
                    $nota_componente+= $componenteFaseUno->not_promedio;
                }
            }
            $componente['promedio'] = $nota_componente/$componente->sub_componentes->count();
        }
        $data=['propuesta' => $propuesta,'componentes'=>$componentes];
        $pdf = PDF::loadView('intranet.propuestas.admin.exportar.exportar_pdf',$data);

        return $pdf->download('Reporte notas '. $propuesta->codigo .'.pdf');
    }

    public function exportar_notas_dos($id)
    {
        $propuesta = Propuesta::findOrFail($id);
        $componentes = Componente::get();
        $notas=[];
        foreach ($componentes as $componente) {
            $nota_componente =0;
            foreach ($propuesta->componentesFaseUno as $componenteFaseUno) {
                if ($componenteFaseUno->subcomponente->componente_id == $componente->id) {
                    $nota_componente+= $componenteFaseUno->not_promedio;
                }
            }
            $componente['promedio'] = $nota_componente/$componente->sub_componentes->count();
        }
        $data=['propuesta' => $propuesta,'componentes'=>$componentes];
        $pdf = PDF::loadView('intranet.propuestas.admin.exportar.exportar_dos_pdf',$data);

        return $pdf->download('Reporte notas Final - '. $propuesta->codigo .'.pdf');
    }




    /**
     * Show the form for creating a new resource.
     */
    public function crear()
    {
        $componentes = Componente::get();
        $usuario = Persona::findOrFail(session('id_usuario'));
        return view('intranet.propuestas.emprendedor.registrar.index',compact('componentes','usuario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function guardar(Request $request)
    {
        //Propuesta
        $propuesta_new['descripcion'] = $request['descripcion'];
        $propuesta_new['sector'] = $request['sector'];
        $propuesta_new['annos'] = $request['annos'];
        $propuesta_new['meses'] = $request['meses'];
        $propuesta_new['estado'] = 2;
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('informe')) {
            $ruta = Config::get('constantes.folder_doc_proyectos');
            $ruta = trim($ruta);
            $informe = $request->informe;
            $nombre_doc = time() . '-' . utf8_encode(utf8_decode($informe->getClientOriginalName()));
            $propuesta_new['informe'] = $nombre_doc;
            $informe->move($ruta, $nombre_doc);
        }
        // - - - - - - - - - - - - - - - - - - - - - - - -
        // - - - - - - - - - - - - - - - - - - - - - - - -
        Propuesta::findOrFail($request['propuestas_id'])->update($propuesta_new);
        unset($propuesta_new);
        $propuesta = Propuesta::findOrFail($request['propuestas_id']);
        // - - - - - - - - - - - - - - - - - - - - - - - -
        // - - - - - - - - - - - - - - - - - - - - - - - -
        if ($request->hasFile('canvas')) {
            $ruta = Config::get('constantes.folder_doc_proyectos');
            $ruta = trim($ruta);
            $canvas = $request->canvas;
            $nombre_doc = time() . '-' . utf8_encode(utf8_decode($canvas->getClientOriginalName()));
            $canvas->move($ruta, $nombre_doc);
            $componenteNew['canvas'] = $nombre_doc;
            $componenteNew['estado'] = 2;
            $primeraFase_ = PrimFaseComponente::where('propuestas_id',$request['propuestas_id'])->where('sub_componente_id',1)->get();
            foreach ($primeraFase_ as $item) {
                $primeraFase = $item;
            }
            PrimFaseComponente::findOrFail($primeraFase->id)->update($componenteNew);
            unset($componenteNew);
        }
        //=========================================================
        //componentes Primera fase
        $sub_componentes = SubComponente::get();
        $cont =0;
        foreach ($sub_componentes as $sub_componente) {
            if ($sub_componente->id > 1) {
                if ($sub_componente->id == 2) {
                    $urlVideo = str_replace("youtu.be", "youtube.com", $request['video']);
                    $urlVideo = str_replace("youtube.com", "youtube.com/embed", $urlVideo);
                    $componenteNew['video'] = $urlVideo;
                    $componenteNew['estado'] = 2;
                    $primeraFase_ = PrimFaseComponente::where('propuestas_id',$request['propuestas_id'])->where('sub_componente_id',2)->get();
                    foreach ($primeraFase_ as $item) {
                        $primeraFase = $item;
                    }
                    PrimFaseComponente::findOrFail($primeraFase->id)->update($componenteNew);
                    unset($componenteNew);
                }elseif($sub_componente->id == 31){
                    if ($request->hasFile('excel')) {
                        $ruta = Config::get('constantes.folder_doc_proyectos');
                        $ruta = trim($ruta);
                        $excel = $request->excel;
                        $nombre_doc = time() . '-' . utf8_encode(utf8_decode($excel->getClientOriginalName()));
                        $excel->move($ruta, $nombre_doc);
                        $componenteNew['excel'] = $nombre_doc;
                        $componenteNew['estado'] = 2;
                        $primeraFase_ = PrimFaseComponente::where('propuestas_id',$request['propuestas_id'])->where('sub_componente_id',31)->get();
                        foreach ($primeraFase_ as $item) {
                            $primeraFase = $item;
                        }
                        PrimFaseComponente::findOrFail($primeraFase->id)->update($componenteNew);
                        unset($componenteNew);
                    }

                } else {
                    $componenteNew['sustentacion'] = $request['sustentacion'][$cont];
                    $componenteNew['estado'] = 2;
                    $primeraFase_ = PrimFaseComponente::where('propuestas_id',$request['propuestas_id'])->where('sub_componente_id',$sub_componente->id)->get();
                    foreach ($primeraFase_ as $item) {
                        $primeraFase = $item;
                    }
                    PrimFaseComponente::findOrFail($primeraFase->id)->update($componenteNew);
                    unset($componenteNew);
                    $cont++;
                }
            }
        }
        //=========================================================
        //pfds
        $i=1;
        $ruta = Config::get('constantes.folder_doc_proyectos');
        $ruta = trim($ruta);
        foreach ($propuesta->componentesFaseUno as $componente) {
            if (isset($request['pdf'][$i])&& $componente->sub_componente_id>2) {
                for ($k=1; $k < (count($request['pdf'][$i]))+1 ; $k++) {
                    $pdf = $request['pdf'][$i][$k];
                    $nombre_doc = utf8_encode(utf8_decode($pdf->getClientOriginalName()));
                    $nombre_arch = time() . '-' . utf8_encode(utf8_decode($pdf->getClientOriginalName()));
                    $documento_new['prim_fase_componente_id'] = $componente->id;
                    $documento_new['titulo'] = $nombre_doc;
                    $documento_new['archivo'] = $nombre_arch;
                    $pdf->move($ruta, $nombre_arch);
                    Documento::create($documento_new);
                }
            }
            $i++;
        }
        //=========================================================
        //imagenes
        $i=1;
        $ruta = Config::get('constantes.folder_doc_proyectos');
        $ruta = trim($ruta);
        foreach ($propuesta->componentesFaseUno as $componente) {
            if (isset($request['imagen'][$i])&& $componente->sub_componente_id>2) {
                for ($k=1; $k < (count($request['imagen'][$i]))+1 ; $k++) {
                    // - - - - - - - - - - - - - - - - - - - - - - - -
                    $ruta = Config::get('constantes.folder_img_empresas');
                    $ruta = trim($ruta);

                    $imagen_nueva = $request['imagen'][$i][$k];
                    $imagen_nueva_archivo = Image::read($imagen_nueva);

                    $imagen_nueva_bd_titu = utf8_encode(utf8_decode($imagen_nueva->getClientOriginalName()));
                    $imagen_nueva_bd = time() . '-' . utf8_encode(utf8_decode($imagen_nueva->getClientOriginalName()));
                    $imagen_nueva_archivo->resize(600, 600);
                    $imagen_nueva_archivo->save($ruta . $imagen_nueva_bd, 100);
                    $fotosNew['titulo'] = $imagen_nueva_bd_titu;
                    $fotosNew['foto'] = $imagen_nueva_bd;
                    $fotosNew['prim_fase_componente_id'] = $componente->id;
                    Foto::create($fotosNew);

                }
            }
            $i++;
        }
        //=========================================================
        return redirect('dashboard')->with('mensaje', 'Propuesta creada con exito');
    }

    public function refrescar_notas(){
        $propuestas = Propuesta::get();
        foreach ($propuestas as $propuesta) {
            $promedioPropuesta =0;
            $sumPromedioPropuesta =0;
            foreach ($propuesta->componentesFaseUno as $componente) {
                $promedioComponente = 0;
                if ($componente->notas->count()>0) {
                    $notasSuma =0;
                    foreach ($componente->notas as $nota) {
                        $notasSuma+= $nota->calificacion;
                    }
                    $promedioComponente = $notasSuma / $componente->notas->count();
                }
                $primerafaseUpdate['not_promedio'] = $promedioComponente;
                PrimFaseComponente::findOrFail($componente->id)->update($primerafaseUpdate);
                $sumPromedioPropuesta+=$promedioComponente;
            }
            //-----------------------------------------------------------
            $componentes = Componente::get();
            $sumNotasComponente =0;
            foreach ($componentes as $componente) {
                $nota_componente =0;
                foreach ($propuesta->componentesFaseUno as $componenteFaseUno) {
                    if ($componenteFaseUno->subcomponente->componente_id == $componente->id) {
                        $nota_componente+= $componenteFaseUno->not_promedio;
                    }
                }
                $componente['promedio'] = $nota_componente/$componente->sub_componentes->count();
                $sumNotasComponente+=$nota_componente/$componente->sub_componentes->count();
            }
            $propuestaUpdate['promedio_primera'] = $sumNotasComponente/$componentes->count();
            Propuesta::findOrfail($propuesta->id)->update($propuestaUpdate);
        }
        return redirect('dashboard')->with('mensaje', 'Se actualizaron los promedios de las notas de manera exitosa en la plataforma');
    }
}
