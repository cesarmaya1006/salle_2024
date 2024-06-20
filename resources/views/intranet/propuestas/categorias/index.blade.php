@extends('intranet.layout.app')

@section('css_pagina')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" />
@endsection

@section('titulo_pagina')
    <i class="fas fa-sitemap mr-3" aria-hidden="true"></i> Propuestas Categorías Componentes
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Categorias Componente</li>
@endsection

@section('titulo_card')
    Listado de Categorías Componentes
@endsection

@section('botones_card')
    <a href="{{ route('componentes.create') }}" class="btn btn-info btn-sm btn-sombra text-center pl-5 pr-5 float-md-end">
        <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
        Nuevo registro
    </a>
@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-md-center">
        <div class="col-12 col-md-6 table-responsive">
            <table class="table table-striped table-hover table-sm tabla_data_table_s tabla-borrando">
                <thead class="thead-inverse">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Categoria Componente</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($componentes as $componente)
                        <tr>
                            <td class="text-center">{{ $componente->id }}</td>
                            <td class="text-center">{{ $componente->componente }}</td>
                            <td class="text-center">
                                <a href="{{ route('componentes.edit', ['id' => $componente->id]) }}" class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                    <i class="fas fa-pen-square"></i>
                                </a>
                                <form action="{{ route('componentes.destroy', ['id' => $componente->id]) }}" class="d-inline form-eliminar" method="POST">
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
