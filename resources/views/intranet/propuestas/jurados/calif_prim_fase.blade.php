@extends('intranet.layout.app')

@section('css_pagina')

@endsection

@section('titulo_pagina')
    <i class="fas fa-graduation-cap mr-3" aria-hidden="true"></i> Jurados
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Calificación Primera fase</li>
@endsection

@section('titulo_card')
    Calificación Primera Fase
@endsection

@section('botones_card')
    <a href="{{ route('dashboard') }}" class="btn btn-success btn-sm btn-sombra text-center pl-5 pr-5 float-md-end"
    style="font-size: 0.8em;">
    <i class="fas fa-reply mr-2"></i>
    Volver
    </a>
@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-around">
        <div class="col-12">
            <p style="font-size: 1.2em;">Titulo de la propuesta: <strong>{{ $propuesta->titulo }}</strong></p>
            <p style="font-size: 1.2em;">Código: <strong>{{ $propuesta->codigo }}</strong></p>
            <p style="font-size: 1.2em;">Emprendedor:
                <strong>{{ $propuesta->emprendedor->nombre1 . ' ' . $propuesta->emprendedor->nombre2 . ' ' . $propuesta->emprendedor->apellido1 . ' ' . $propuesta->emprendedor->apellido2 }}</strong>
            </p>
        </div>
        <div class="col-12">
            <h6><strong>Descripción:</strong></h6>
            <p style="text-align: justify">{{ $propuesta->descripcion }}</p>
        </div>
        <div class="col-12 col-md-5">
            <div class="row">
                <div class="col-12">
                    <h6><strong>Documento Final Propuesta de Negocio</strong></h6>
                </div>
                <div class="col-12"><iframe src="{{ asset('documentos/proyectos/' . $propuesta->informe) }}"
                        style="width:100%;height: 600pX;" frameborder="0"></iframe></div>
            </div>
        </div>
        <div class="col-12">
            <h6><strong>Sector Socio - Económico:</strong></h6>
            <p style="text-align: justify">{{ $propuesta->sector }}</p>
        </div>
        <div class="col-12">
            <h6><strong>Tiempo de antiguedad / experiencia:</strong></h6>
            <p style="text-align: justify">{{ $propuesta->annos }} años {{ $propuesta->meses }} meses de antiguedad </p>
        </div>
    </div>
    <hr>
    <div class="row mt-3 mb-3">
        <div class="col-12">
            <h4>Componentes de la propuesta</h4>
            <h5>(Escala de calificación: 0 mínimo - 10 máximo)</h5>
        </div>
    </div>
    <hr>
    @foreach ($componentes as $componente)
        <div class="accordion accordion-flush" id="accordionComponentes">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading{{ $componente->id }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse{{ $componente->id }}" aria-expanded="false"
                        aria-controls="flush-collapse{{ $componente->id }}">
                        <h5><strong>{{ $componente->componente }}</strong></h5>
                    </button>
                </h2>
                <div id="flush-collapse{{ $componente->id }}" class="accordion-collapse collapse"
                    aria-labelledby="flush-heading{{ $componente->id }}" data-bs-parent="#accordionComponentes">
                    <div class="row mt-4">
                        @foreach ($componente->sub_componentes as $sub_componente)
                            <div
                                class="col-11 {{ $sub_componente->sub_componente != 'Canvas' && $sub_componente->sub_componente != 'Video' ? 'col-md-12' : 'col-md-6' }}">
                                <div class="card card-outline">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-12">
                                                <h6 class="card-title">
                                                    <strong>{{ $sub_componente->sub_componente }}</strong></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row" style="font-size: 1.4em;">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12"><strong>Sustentacion del componente</strong></div>
                                                    @if (
                                                        $sub_componente->sub_componente != 'Canvas' &&
                                                            $sub_componente->sub_componente != 'Video' &&
                                                            $sub_componente->sub_componente != 'Propuesta de cofinanciamiento')
                                                        <div class="col-12">
                                                            @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                                                @if ($componenteFaseUno->sub_componente_id == $sub_componente->id)
                                                                    <div class="sustentacion">
                                                                        <p style="text-align: justify">
                                                                            {{ $componenteFaseUno->sustentacion }}</p>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        @if ($sub_componente->sub_componente == 'Canvas')
                                                            @php
                                                                $contador = 0;
                                                            @endphp
                                                            @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                                                @if ($componenteFaseUno->sub_componente_id == $sub_componente->id)
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <h6><strong>Documento Canvas</strong></h6>
                                                                            </div>
                                                                            <div class="col-12"><iframe
                                                                                    src="{{ asset('documentos/proyectos/' . $componenteFaseUno->canvas) }}"
                                                                                    style="width:100%;height: 600pX;"
                                                                                    frameborder="0"></iframe></div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            @if ($sub_componente->sub_componente == 'Video')
                                                                @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                                                    @if ($componenteFaseUno->sub_componente_id == $sub_componente->id)
                                                                        <div class="col-12">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <h6><strong>Video Apoyo</strong></h6>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div
                                                                                        class="embed-responsive embed-responsive-16by9 w-100">
                                                                                        <iframe width="560"
                                                                                            height="315"
                                                                                            src="{{ $componenteFaseUno->video }}"
                                                                                            title="YouTube video player"
                                                                                            frameborder="0"
                                                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                                                            allowfullscreen></iframe>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                                                    @if ($componenteFaseUno->sub_componente_id == $sub_componente->id)
                                                                        <div class="col-12">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <h6><strong>Propuesta de
                                                                                            cofinanciamiento</strong></h6>
                                                                                </div>
                                                                                <div class="col-12"><a
                                                                                        href="{{ asset('documentos/proyectos/' . $componenteFaseUno->excel) }}"
                                                                                        target="_blank"
                                                                                        rel="noopener noreferrer">Documento
                                                                                        Propuesta descargar</a></div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                            @if (
                                                ($componenteFaseUno->documentos->count() || $componenteFaseUno->fotos->count()) &&
                                                    $componenteFaseUno->sub_componente_id == $sub_componente->id)
                                                <hr>
                                                <div class="row">
                                                    <div class="col-12 mb-3" style="border-bottom: 1px solid black">
                                                        <h6><strong>Archivos adjuntos del componente</strong></h6>
                                                    </div>
                                                    <div class="col-12">
                                                        @if ($componenteFaseUno->documentos->count())
                                                            <div class="row">
                                                                <div class="col-12 mb-3">
                                                                    <strong>Documentos</strong>
                                                                </div>
                                                                <div class="col-12">
                                                                    <ul>
                                                                        @foreach ($componenteFaseUno->documentos as $documento)
                                                                            @if ($documento->componenteFaseUno->sub_componente_id == $sub_componente->id)
                                                                                <li><a href="{{ asset('documentos/proyectos/' . $documento->archivo) }}"
                                                                                        target="_blank">{{ $documento->titulo }}</a>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        @endif
                                                        @if ($componenteFaseUno->fotos->count())
                                                            <div class="row">
                                                                <div class="col-12 mb-3">
                                                                    <strong>Imagenes de apoyo</strong>
                                                                </div>
                                                                <div class="col-12">
                                                                    <ul>
                                                                        @foreach ($componenteFaseUno->fotos as $foto)
                                                                            @if ($foto->componenteFaseUno->sub_componente_id == $sub_componente->id)
                                                                                <li><a href="{{ asset('documentos/proyectos/' . $foto->foto) }}"
                                                                                        target="_blank">{{ $foto->titulo }}</a>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                @php
                                                    $cantNotas = 0;
                                                    $prim_fase_componentes_id = 0;
                                                @endphp
                                                @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                                    @if ($componenteFaseUno->sub_componente_id == $sub_componente->id)
                                                        @php
                                                            $prim_fase_componentes_id = $componenteFaseUno->id;
                                                            $cantNotas = $componenteFaseUno->notas
                                                                ->where('personas_id', session('id_usuario'))
                                                                ->count();
                                                            foreach (
                                                                $componenteFaseUno->notas->where(
                                                                    'personas_id',
                                                                    session('id_usuario'),
                                                                )
                                                                as $nota
                                                            ) {
                                                                $nota_f = $nota->calificacion;
                                                                $observacion_f = $nota->observacion;
                                                            }
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @if ($cantNotas > 0)
                                                    <div class="row"
                                                        id="caja_componente_span_{{ $prim_fase_componentes_id }}">
                                                        <div class="col-12 col-md-3 form-group">
                                                            <label for="calificacion"
                                                                class="requerido">Calificación</label>
                                                            <span class="form-control form-control-sm "
                                                                id="span_calificacion_{{ $prim_fase_componentes_id }}">
                                                                {{ $nota_f }}
                                                            </span>
                                                        </div>
                                                        <div class="col-12 form-group">
                                                            <label for="observacion">Observaciones</label>
                                                            <p class=""
                                                                id="observacion_span_{{ $prim_fase_componentes_id }}"
                                                                style="text-align: justify">{{ $observacion_f }}</p>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row d-none"
                                                        id="caja_componente_span_{{ $prim_fase_componentes_id }}">
                                                        <div class="col-12 col-md-3 form-group">
                                                            <label for="calificacion"
                                                                class="requerido">Calificación</label>
                                                            <span class="form-control form-control-sm "
                                                                id="span_calificacion_{{ $prim_fase_componentes_id }}"></span>
                                                        </div>
                                                        <div class="col-12 form-group">
                                                            <label for="observacion">Observaciones</label>
                                                            <p class=""
                                                                id="observacion_span_{{ $prim_fase_componentes_id }}"
                                                                style="text-align: justify"></p>
                                                        </div>
                                                    </div>
                                                    <form
                                                        action="{{ route('calificar_primera_fase-guardar', ['id' => $prim_fase_componentes_id]) }}"
                                                        class="form-horizontal row form_calificar_fase_uno" method="POST"
                                                        autocomplete="off" id="form_{{ $prim_fase_componentes_id }}">
                                                        @csrf
                                                        @method('post')
                                                        <div class="row">
                                                            <div class="col-12 col-md-3 form-group">
                                                                <label for="calificacion"
                                                                    class="requerido">Calificación</label>
                                                                <input type="number"
                                                                    class="form-control form-control-sm number_calificacion"
                                                                    name="calificacion"
                                                                    id="calificacion_{{ $prim_fase_componentes_id }}"
                                                                    min="0" max="10" value="0"
                                                                    required>
                                                                <small id="helpId" class="form-text text-muted">valores
                                                                    entre 0-10</small>
                                                            </div>
                                                            <div class="col-12 col-md-9 form-group">
                                                                <label for="observacion">Observaciones</label>
                                                                <textarea class="form-control form-control-sm" name="observacion" id="observacion_{{ $prim_fase_componentes_id }}"
                                                                    cols="30" rows="2"></textarea>
                                                                <small id="helpId"
                                                                    class="form-text text-muted">Observaciones</small>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <button class="btn btn-primary btn-xs btn-sombra pl-4 pr-4"
                                                                    type="submit">Guardar</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                        <hr style="border-bottom: 4px solid black;">
                                    </div>
                                    <div class="card-footer">

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('footer_card')
@endsection

@section('modales')
@endsection

@section('scripts_pagina')
    <script src="{{ asset('js/intranet/propuestas/jurados/calificacion_primera_fase.js') }}"></script>
@endsection
