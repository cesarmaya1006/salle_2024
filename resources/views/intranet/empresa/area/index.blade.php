@extends('intranet.layout.app')

@section('css_pagina')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" />
@endsection

@section('titulo_pagina')
    <i class="fas fa-project-diagram mr-3" aria-hidden="true"></i> Configuración Áreas
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Áreas</li>
@endsection

@section('titulo_card')
    Listado de Areas
@endsection

@section('botones_card')
    @can('areas.create')
        <a href="{{ route('areas.create') }}" class="btn btn-info btn-sm btn-sombra text-center pl-5 pr-5 float-md-end">
            <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
            Nuevo registro
        </a>
    @endcan
@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-md-center">
        <div class="col-12 col-md-10 table-responsive">
            <input type="hidden" name="titulo_tabla" id="titulo_tabla" value="Listado de Areas">
            <table class="table table-striped table-hover table-sm tabla_data_table_m tabla-borrando" id="tabla-data">
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Area</th>
                        <th class="text-center">Area Superior</th>
                        <th class="text-center">Dependencias</th>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($areas as $area)
                        <tr>
                            <td class="text-center">{{ $area->id }}</td>
                            <td class="text-center">{{ $area->area }}</td>
                            <td class="text-center">{{ $area->area_id != null ? $area->area_sup->area : '---' }}</td>
                            <td class="text-center">
                                @if ($area->areas->count() > 0)
                                    <button type="submit" class="btn-accion-tabla tooltipsC mostrar_dependencias text-info"
                                        title="Mostrar Dependencias" data_id = "{{ $area->id }}"
                                        data_url = "{{ route('areas.getDependencias', ['id' => $area->id]) }}">
                                        {{ $area->empresa->areas->where('area_id', $area->id)->count() }}
                                    </button>
                                @else
                                    <h6 class="text-danger">---</h6>
                                @endif
                            </td>
                            <td class="d-flex justify-content-evenly align-items-center">
                                <a href="{{ route('areas.edit', ['id' => $area->id]) }}" class="btn-accion-tabla tooltipsC"
                                    title="Editar este registro">
                                    <i class="fas fa-pen-square"></i>
                                </a>
                                <form action="{{ route('areas.destroy', ['id' => $area->id]) }}"
                                    class="d-inline form-eliminar" method="POST">
                                    @csrf @method('delete')
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
<!-- Modales  -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Listado de dependencias</h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info boton_cerrar_modal">Cerrar Lista</button>
        </div>
    </div>
    </div>
</div>
<!-- Fin Modales  -->
@endsection

@section('scripts_pagina')
    <script src="{{ asset('js/intranet/configuracion/areas/index.js') }}"></script>
    @include('intranet.layout.script_datatable')
@endsection
