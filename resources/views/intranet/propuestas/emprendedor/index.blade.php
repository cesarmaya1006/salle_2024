@extends('intranet.layout.app')

@section('css_pagina')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" />
@endsection

@section('titulo_pagina')
    <i class="fas fa-user-graduate mr-3" aria-hidden="true"></i> Emprendedores
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Emprendedores</li>
@endsection

@section('titulo_card')
Emprendedores
@endsection

@section('botones_card')
    <a href="{{ route('dashboard') }}" class="btn btn-success btn-sm btn-sombra text-center pl-5 pr-5 float-md-end"
    style="font-size: 0.8em;">
    <i class="fas fa-reply mr-2"></i>
    Volver
    </a>
@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-md-center">
        <div class="col-12 table-responsive">
            <table class="table table-striped table-hover table-sm tabla_data_table_l tabla-borrando">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center" scope="col">Id</th>
                        <th class="text-center" scope="col">N. Identificacion</th>
                        <th class="text-center" scope="col">Nombres y Apellidos</th>
                        <th class="text-center" scope="col">Telefono</th>
                        <th class="text-center" scope="col">Email</th>
                        <th class="text-center" scope="col">Propuesta registrada</th>
                    </tr>
                </thead>
                <tbody id="cuerpo_tabla_usuarios2">
                    @foreach ($emprendedores as $emprendedor)
                        <tr>
                            <td class="text-center text-nowrap">{{ $emprendedor->id }}</td>
                            <td class="text-center text-nowrap">{{$emprendedor->identificacion}}</td>
                            <td class="text-left text-nowrap">{{$emprendedor->nombre1 . ' ' . $emprendedor->nombre2 . ' ' . $emprendedor->apellido1 . ' ' . $emprendedor->apellido2}}</td>
                            <td class="text-center text-nowrap">{{$emprendedor->telefono}}</td>
                            <td class="text-left text-nowrap">{{$emprendedor->email}}</td>
                            <td class="text-center text-nowrap">{{$emprendedor->propuesta->estado > 1?'SI':'NO'}}</td>
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
