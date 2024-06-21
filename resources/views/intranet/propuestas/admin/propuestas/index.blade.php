@extends('intranet.layout.app')

@section('css_pagina')
<link rel="stylesheet" href="{{asset('lte/lte4/css/adminlte.css')}}">
@endsection

@section('titulo_pagina')
    <i class="fas fa-folder-open mr-3" aria-hidden="true"></i> Propuestas
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
<li class="breadcrumb-item active">Propuestas</li>
@endsection

@section('titulo_card')
Administración de Propuestas
@endsection

@section('botones_card')

@endsection

@section('cuerpo')
    <div class="container-fluid">
        <div class="row d-flex justify-content-md-center">
            <div class="col-12 table-responsive">
                <table class="table table-striped table-hover table-sm tabla_data_table_l tabla-borrando">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="text-center">#</th>
                            <th class="text-center">Emprendedor</th>
                            <th class="text-center">Titulo</th>
                            <th class="text-center">Descripción</th>
                            <th class="text-center">Cant Componentes</th>
                            <th class="text-center">Jurados Asignados</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Nota Promedio 1era Fase</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($propuestas as $propuesta)
                            <tr>
                                <td>
                                    <a href="{{route('propuestas.propuestas_ver',['id' => $propuesta->id])}}"
                                        class="btn-accion-tabla tooltipsC text-info" title="Ver Propuesta"><i
                                            class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                                <td class="text-center">{{ $propuesta->id }}</td>
                                <td class="text-center">{{ $propuesta->emprendedor->nombre1 }} {{ $propuesta->emprendedor->nombre2!=null? ' ' .$propuesta->emprendedor->nombre2:'' }} {{ ' '.$propuesta->emprendedor->apellido1 }} {{ $propuesta->emprendedor->apellido!=null? ' ' .$propuesta->emprendedor->apellido:'' }}</td>
                                <td class="text-center">{{ $propuesta->titulo }}</td>
                                <td class="text-center">{{ $propuesta->descripcion??'' }}</td>
                                <td class="text-center">{{ $propuesta->componentesFaseUno->Count() }}</td>
                                <td class="text-center">
                                    <strong>{{$propuesta->jurados->Count()}}</strong>
                                </td>
                                <td class="text-center">
                                    <div class="row">
                                        <div class="col-12">
                                            {{ $propuesta->estado_str}}
                                        </div>
                                        <div class="col-12">
                                            {!!$propuesta->barra_progreso!!}
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ number_format($propuesta->promedio_primera,'4','.',',')??'Sin Calificación' }}</td>
                                <td>
                                    @if ($propuesta->estado==1)
                                        {{ $propuesta->estado_str}}
                                    @else
                                        @if ($propuesta->estado<4)
                                            @if ($propuesta->jurados->Count()>0)
                                                <a href="{{route('propuestas-asignar',['id' => $propuesta->id])}}" class="btn btn-success bg-gradient btn-sombra btn-xs pl-3 pr-3 ml-3">ModificarJurados</a>
                                            @else
                                                <a href="{{route('propuestas-asignar',['id' => $propuesta->id])}}" class="btn btn-danger bg-gradient btn-sombra btn-xs pl-3 pr-3">Asignar Jurados</a>
                                            @endif
                                        @else
                                            <a href="{{route('exportar_notas',['id' => $propuesta->id])}}" class="btn btn-info bg-gradient btn-sombra btn-xs pl-3 pr-3 ml-3"><i class="fas fa-file-download    "></i> Descargar Informe</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer_card')
@endsection

@section('modales')
@endsection

@section('scripts_pagina')
@include('intranet.layout.script_datatable')
@endsection
