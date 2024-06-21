@extends('intranet.layout.app')

@section('css_pagina')

@endsection

@section('titulo_pagina')
    <i class="fas fa-folder-open mr-3" aria-hidden="true"></i> Propuestas
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Registro de propuestas</li>
@endsection

@section('titulo_card')
    <div class="row">
        <div class="col-12">
            <h4 class="m-0 mb-2">{{$usuario->propuesta->titulo}}</h4>
            <h6><strong>Codigo:</strong>{{$usuario->propuesta->codigo}}</h6>
        </div>
    </div>
@endsection

@section('botones_card')
<a href="{{ route('dashboard') }}" class="btn btn-success btn-sm btn-sombra text-center pl-5 pr-5 float-md-end" style="font-size: 0.8em;">
    <i class="fas fa-reply mr-2"></i>
    Volver
</a>
@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-center" id="form_registrar_parent">
        <form class="col-12 form-horizontal form_propuesta_guardar"
              action="{{ route('propuestas.guardar') }}"
              method="POST"
              autocomplete="off"
              enctype="multipart/form-data" id="form_propuesta_guardar"
              novalidate>
            @csrf
            @method('post')
            @include('intranet.propuestas.emprendedor.registrar.form_2')
            <div class="row mt-5">
                <div class="col-12 mb-4 mb-md-0 d-grid gap-2 d-md-block ">
                    <button type="submit" class="btn btn-primary btn-sm btn-sombra pl-sm-5 pr-sm-5" id="boton_registrar" style="font-size: 0.8em;">Registrar</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer_card')
@endsection

@section('modales')
@endsection

@section('scripts_pagina')
    <script src="{{ asset('js/intranet/propuestas/registrar.js') }}"></script>
@endsection
