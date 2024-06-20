@extends('intranet.layout.app')

@section('css_pagina')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css" />
@endsection

@section('titulo_pagina')
    <i class="fas fa-graduation-cap mr-3" aria-hidden="true"></i> Jurados
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
<li class="breadcrumb-item"><a href="{{ route('jurados.index') }}">Jurados</a></li>
    <li class="breadcrumb-item active">Asignación</li>
@endsection

@section('titulo_card')
Asignación de Propuestas
@endsection

@section('botones_card')

@endsection

@section('cuerpo')
    <div class="row">
        <div class="col-12">
            <h4>Asignación de jurados a las propuestas</h4>
        </div>
        <div class="col-12 table-responsive">
            <table class="table table-striped table-hover table-sm tabla_data_table_s tabla-borrando">
                <thead class="thead-inverse">
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Propuesta</th>
                        <th class="text-center">Jurados</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($propuestas as $propuesta)
                        @if ($propuesta->estado > 1)
                            <tr>
                                <td>{{ $propuesta->id }}</td>
                                <td>
                                    <h5><strong>{{ $propuesta->titulo }}</strong></h5>
                                    <h6>Emprendedor:
                                        <strong>{{ $propuesta->emprendedor->nombre1 . ' ' . $propuesta->emprendedor->nombre2 . ' ' . $propuesta->emprendedor->apellido1 . ' ' . $propuesta->emprendedor->apellido2 }}</strong>
                                    </h6>
                                    Código: <strong>{{ $propuesta->codigo }}</strong>
                                </td>
                                <td>
                                    <ul>
                                        @foreach ($jurados as $jurado)
                                            <li style="list-style:none">
                                                <div class="form-check">
                                                    <input class="form-check-input jurado_check" type="checkbox"
                                                        data_url="{{ route('propuestas-asignar_guardar_dos', ['persona_id' => $jurado->id, 'propuesta_id' => $propuesta->id]) }}"
                                                        name="persona_id" value="{{ $jurado->id }}"
                                                        id="jurado_{{ $jurado->id }}"
                                                        @foreach ($propuesta->jurados_dos as $item)
                                                            @if ($item->id == $jurado->id)
                                                            checked
                                                            @endif
                                                            @if ($item->notas_dos->count() > 0)
                                                            disabled
                                                            @endif
                                                        @endforeach>
                                                    <label class="form-check-label" for="flexCheckChecked"
                                                        style="font-size: 1.3em;">
                                                        {{ $jurado->nombre1 . ' ' . $jurado->nombre2 . ' ' . $jurado->apellido1 . ' ' . $jurado->apellido2 }}
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endif
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
    <script src="{{asset('js/intranet/propuestas/jurados/asignacion.js')}}"></script>
    @include('intranet.layout.script_datatable')
@endsection
