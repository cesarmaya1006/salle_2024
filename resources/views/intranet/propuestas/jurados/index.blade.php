@extends('intranet.layout.app')

@section('css_pagina')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" />
@endsection

@section('titulo_pagina')
    <i class="fas fa-graduation-cap mr-3" aria-hidden="true"></i> Jurados
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Jurados</li>
@endsection

@section('titulo_card')
Parametrización de Jurados
@endsection

@section('botones_card')
    <div class="row">
        <div class="col-12 col-md-6 pl-md-2 pr-md-2 pb-3 pb-md-0 text-small">
            <a href="{{route('jurados.asignacion_dos')}}" class="btn btn-primary btn-sm btn-sombra text-center pl-5 pr-5 float-md-end text-nowrap">
                <i class="fas fa-user-check mr-2"></i> Asignación de Propuestas Fase Dos
            </a>
        </div>
        <div class="col-12 col-md-6 pl-md-2 pr-md-2 pb-3 pb-md-0 text-small">
            <a href="{{route('jurados.asignacion')}}" class="btn btn-info btn-sm btn-sombra text-center pl-5 pr-5 float-md-end">
                <i class="fas fa-user-check mr-2"></i> Asignación de Propuestas
            </a>
        </div>
    </div>
@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-md-center">
        <div class="col-12 table-responsive">
            <table class="table table-striped table-hover table-sm tabla_data_table_s tabla-borrando">
                <thead class="thead-inverse">
                    <tr>
                        <th class="text-center" scope="col">Id</th>
                        <th class="text-center" scope="col">N. Identificacion</th>
                        <th class="text-center" scope="col">Nombres y Apellidos</th>
                        <th class="text-center" scope="col">Telefono</th>
                        <th class="text-center" scope="col">Email</th>
                        <th class="text-center" scope="col">Propuestas asignadas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jurados as $jurado)
                    <tr>
                        <td class="text-center text-nowrap">{{ $jurado->persona->id }}</td>
                        <td class="text-left text-nowrap">{{$jurado->persona->identificacion}}</td>
                        <td class="text-left text-nowrap">{{$jurado->persona->nombre1 . ' ' . $jurado->persona->nombre2 . ' ' . $jurado->persona->apellido1 . ' ' . $jurado->persona->apellido2}}</td>
                        <td class="text-right text-nowrap">{{$jurado->persona->telefono}}</td>
                        <td class="text-left text-nowrap">{{$jurado->persona->email}}</td>
                        <td class="text-center text-nowrap">{{$jurado->persona->propuestas_j->count()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
