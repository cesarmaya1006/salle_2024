@extends('intranet.layout.app')

@section('css_pagina')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" />
@endsection

@section('titulo_pagina')
    <i class="fas fa-graduation-cap mr-3" aria-hidden="true"></i> Jurados
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Calificación Segunda Fase</li>
@endsection

@section('titulo_card')
    Calificación Segunda Fase
@endsection

@section('botones_card')
    <a href="{{ route('dashboard') }}" class="btn btn-success btn-sm btn-sombra text-center pl-5 pr-5 float-md-end"
    style="font-size: 0.8em;">
    <i class="fas fa-reply mr-2"></i>
    Volver
    </a>
@endsection

@section('cuerpo')
    <div class="container-fluid">
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
                <p style="text-align: justify">{{ $propuesta->annos }} años {{ $propuesta->meses }} meses de
                    antiguedad </p>
            </div>
        </div>
        <hr>
        <div class="row mt-3 mb-3">
            <div class="col-12">
                <h4>Componentes de la propuesta fase dos</h4>
                <h5>(Escala de calificación: 0 mínimo - 10 máximo)</h5>
            </div>
        </div>
        <hr>
        <div class="row">
            @foreach ($componentes as $componente)
                <div class="col-12">
                    <div class="card card-outline card-warning">
                        <div class="card-header">
                            <h3 class="card-title"><strong>{{ $componente->componente }}</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @php
                                        $cantNotas = 0;
                                        $seg_fase_componentes_id = 0;
                                    @endphp
                                    @foreach ($propuesta->componentesFaseDos as $componenteFaseDos)
                                        @if ($componenteFaseDos->componente == $componente->componente)
                                            @php
                                                $seg_fase_componentes_id = $componenteFaseDos->id;
                                                $cantNotas = $componenteFaseDos->notas
                                                    ->where('personas_id', session('id_usuario'))
                                                    ->count();
                                                foreach (
                                                    $componenteFaseDos->notas->where(
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
                                        <div class="row" id="caja_componente_span_{{ $seg_fase_componentes_id }}">
                                            <div class="col-12 col-md-3 form-group">
                                                <label for="calificacion" class="requerido">Calificación</label>
                                                <span class="form-control form-control-sm "
                                                    id="span_calificacion_{{ $seg_fase_componentes_id }}">
                                                    {{ $nota_f }}
                                                </span>
                                            </div>
                                            <div class="col-12 form-group">
                                                <label for="observacion">Observaciones</label>
                                                <p class="" id="observacion_span_{{ $seg_fase_componentes_id }}"
                                                    style="text-align: justify">
                                                    {{ $observacion_f }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row d-none" id="caja_componente_span_{{ $seg_fase_componentes_id }}">
                                            <div class="col-12 col-md-3 form-group">
                                                <label for="calificacion" class="requerido">Calificación</label>
                                                <span class="form-control form-control-sm "
                                                    id="span_calificacion_{{ $seg_fase_componentes_id }}"></span>
                                            </div>
                                            <div class="col-12 form-group">
                                                <label for="observacion">Observaciones</label>
                                                <p class="" id="observacion_span_{{ $seg_fase_componentes_id }}"
                                                    style="text-align: justify"></p>
                                            </div>
                                        </div>
                                        <div class="row d-none" id="caja_loading_{{ $seg_fase_componentes_id }}">
                                            <div class="col-2">
                                                <img class="img-fluid" src="{{ asset('imagenes/sistema/cargando2.gif') }}"
                                                    style="width: 100%; height: 100%;">
                                            </div>
                                        </div>
                                        <form
                                            action="{{ route('calificar_segunda_fase-guardar', ['id' => $seg_fase_componentes_id]) }}"
                                            class="form-horizontal row form_calificar_fase_dos" method="POST"
                                            autocomplete="off" id="form_{{ $seg_fase_componentes_id }}">
                                            @csrf
                                            @method('post')
                                            <div class="row">
                                                <div class="col-12 col-md-3 form-group">
                                                    <label for="calificacion" class="requerido">Calificación</label>
                                                    <input type="number"
                                                        class="form-control form-control-sm number_calificacion"
                                                        name="calificacion"
                                                        id="calificacion_{{ $seg_fase_componentes_id }}" min="0"
                                                        max="10" value="" required>
                                                    <small id="helpId" class="form-text text-muted">valores entre
                                                        0-10</small>
                                                </div>
                                                <div class="col-12 col-md-9 form-group">
                                                    <label for="observacion">Observaciones</label>
                                                    <textarea class="form-control form-control-sm" name="observacion" id="observacion_{{ $seg_fase_componentes_id }}"
                                                        cols="30" rows="2"></textarea>
                                                    <small id="helpId" class="form-text text-muted">Observaciones</small>
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
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('footer_card')
@endsection

@section('modales')
@endsection

@section('scripts_pagina')
    <script src="{{ asset('js/intranet/propuestas/jurados/calificacion_segunda_fase.js') }}"></script>
@endsection
