@extends('intranet.layout.app')

@section('css_pagina')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" />
@endsection

@section('titulo_pagina')
    <i class="fas fa-user-friends mr-3" aria-hidden="true"></i> Configuración Usuarios
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Usuarios</li>
@endsection

@section('titulo_card')
    Listado de Usuarios
@endsection

@section('botones_card')
    <a href="{{ route('usuarios.create') }}" class="btn btn-info btn-sm btn-sombra text-center pl-5 pr-5 float-md-end">
        <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
        Nuevo registro
    </a>
@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-md-center">
        <div class="col-12">
            <div class="accordion" id="accordionExample">
                @foreach ($roles as $rol)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="rol_{{$rol->id}}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$rol->id}}" aria-expanded="true" aria-controls="collapse_{{$rol->id}}">
                                Rol: {{$rol->name}}
                            </button>
                        </h2>
                        <div id="collapse_{{$rol->id}}" class="accordion-collapse collapse" aria-labelledby="heading_{{$rol->id}}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <input type="hidden" name="titulo_tabla" id="titulo_tabla" value="Listado de Usuarios">
                                        <table class="table table-striped table-hover table-bordered table-sm tabla_data_table_l tabla-borrando" id="tabla-data">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" scope="col">Id</th>
                                                    <th class="text-center" scope="col">Usuario</th>
                                                    <th class="text-center" scope="col">N. Identificacion</th>
                                                    <th class="text-center" scope="col">Nombres y Apellidos</th>
                                                    <th class="text-center" scope="col">Teléfono</th>
                                                    <th class="text-center" scope="col">Email</th>
                                                    <th class="text-center" scope="col">Estado</th>
                                                    <th class="text-center" scope="col">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rol->users as $usuario)
                                                    @if ($usuario->persona)
                                                        <tr>
                                                            <td class="text-center text-nowrap">{{ $usuario->persona->id }}</td>
                                                            <td class="text-center text-nowrap">{{ $usuario->username }}</td>
                                                            <td class="text-center text-nowrap">{{$usuario->persona->identificacion}}</td>
                                                            <td class="text-center text-nowrap">{{$usuario->persona->nombre1 . ' ' . $usuario->persona->nombre2 . ' ' . $usuario->persona->apellido1 . ' ' . $usuario->persona->apellido2}}</td>
                                                            <td class="text-center text-nowrap">{{$usuario->persona->telefono}}</td>
                                                            <td class="text-center text-nowrap">{{$usuario->persona->email}}</td>
                                                            <td class="text-center text-nowrap">{{$usuario->persona->estado==1?'Activo':'Inactivo'}}</td>
                                                            <td class="d-flex justify-content-evenly align-items-center">
                                                                <a href="{{ route('usuarios.edit', ['id' => $usuario->id]) }}"
                                                                    class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                                                    <i class="fas fa-pen-square"></i>
                                                                </a>
                                                                <form action="{{ route('usuarios.destroy', ['id' => $usuario->id]) }}"
                                                                    class="d-inline form-eliminar" method="POST">
                                                                    @csrf @method('delete')
                                                                    <button type="submit" class="btn-accion-tabla eliminar tooltipsC"
                                                                        title="Eliminar este registro">
                                                                        <i class="fa fa-fw fa-trash text-danger"></i>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('footer_card')
@endsection

@section('modales')
@endsection

@section('scripts_pagina')
    <script src="{{ asset('js/intranet/usuarios/index.js') }}"></script>
    @include('intranet.layout.script_datatable')
@endsection
