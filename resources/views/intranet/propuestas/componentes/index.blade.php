@extends('intranet.layout.app')

@section('css_pagina')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" />
@endsection

@section('titulo_pagina')
    <i class="fas fa-sort-alpha-down mr-3" aria-hidden="true"></i> Propuestas Componentes
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Propuestas Componentes</li>
@endsection

@section('titulo_card')
Listado de Componentes
@endsection

@section('botones_card')
    <a href="{{ route('subcomponentes.create') }}" class="btn btn-info btn-sm btn-sombra text-center pl-5 pr-5 float-md-end">
        <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
        Nuevo registro
    </a>
@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-md-center">
        <div class="col-12 col-md-8 table-responsive">
            <table class="table table-striped table-hover table-sm tabla_data_table_s tabla-borrando">
                <thead class="thead-inverse">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Categoria Componente</th>
                        <th class="text-center">Componente</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sub_componentes as $componente)
                        <tr>
                            <td class="text-center">{{ $componente->id }}</td>
                            <td>{{ $componente->componente->componente }}</td>
                            <td>{{ $componente->sub_componente }}</td>
                            <td class="text-center">
                                <a href="{{ route('subcomponentes.edit', ['id' => $componente->id]) }}"
                                    class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                    <i class="fas fa-pen-square"></i>
                                </a>
                                <form action="{{ route('subcomponentes.destroy', ['id' => $componente->id]) }}"
                                    class="d-inline form-eliminar" method="POST">
                                    @csrf @method("delete")
                                    <button type="submit" class="btn-accion-tabla eliminar tooltipsC"
                                        title="Eliminar este registro">
                                        <i class="fa fa-fw fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </td>
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
