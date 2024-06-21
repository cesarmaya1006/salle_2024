@extends('intranet.layout.app')

@section('css_pagina')

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
Asignación de jurados a las propuestas
@endsection

@section('botones_card')
    <a href="{{ route('jurados.index') }}" class="btn btn-success btn-sm btn-sombra text-center pl-5 pr-5 float-md-end" style="font-size: 0.8em;">
        <i class="fas fa-reply mr-2"></i>
        Volver
    </a>
@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-md-center">
        <div class="col-12 col-md-8 table-responsive">
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
                        @if ($propuesta->estado>1)
                            <tr>
                                <td>{{$propuesta->id}}</td>
                                <td>
                                    <h5><strong>{{$propuesta->titulo}}</strong></h5>
                                    <h6>Emprendedor: <strong>{{$propuesta->emprendedor->nombre1 . ' ' . $propuesta->emprendedor->nombre2 . ' ' . $propuesta->emprendedor->apellido1 . ' ' . $propuesta->emprendedor->apellido2 }}</strong></h6>
                                    Código: <strong>{{$propuesta->codigo}}</strong>
                                </td>
                                <td>
                                    <ul>
                                        @foreach ($jurados as $jurado)
                                            <li style="list-style:none">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input jurado_check"
                                                        type="checkbox"
                                                        data_url="{{route('propuestas-asignar_guardar',['persona_id' => $jurado->id,'propuesta_id' => $propuesta->id])}}"
                                                        name="persona_id"
                                                        value="{{$jurado->id}}"
                                                        id="jurado_{{$jurado->id}}"
                                                        @foreach ($propuesta->jurados as $item)
                                                            @if ($item->id == $jurado->id)
                                                                checked
                                                            @endif
                                                        @endforeach
                                                        @php
                                                            $check_disable =0;
                                                            foreach ($propuesta->componentesFaseUno as $componenteFaseUno) {
                                                                foreach ($componenteFaseUno->notas as $nota) {
                                                                    if ($jurado->id == $nota->personas_id) {
                                                                        $check_disable =1;
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        @if ($check_disable)
                                                            disabled
                                                        @endif>
                                                        <label class="form-check-label" for="flexCheckChecked" style="font-size: 1.3em;">
                                                            {{$jurado->persona->nombre1 . ' ' . $jurado->persona->nombre2 . ' ' . $jurado->persona->apellido1 . ' ' . $jurado->persona->apellido2}}
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
