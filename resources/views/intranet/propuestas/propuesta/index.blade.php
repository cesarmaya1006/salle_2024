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
Propuestas
@endsection

@section('botones_card')
    @can('propuestas.index')
        <a href="#" class="btn btn-primary btn-sm mini_sombra text-center pl-5 pr-5 float-md-end" style="box-shadow: 5px 5px 3px 0px rgba(0,0,0,0.75);">
            <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
            Nuevo registro
        </a>
    @endcan
@endsection

@section('cuerpo')
    <div class="row d-flex justify-content-md-center">
        <div class="col-12">
            @can('intranet.propuestas.admin.index')
                @include('intranet.propuestas.admin.index')
            @endcan
            @can('intranet.propuestas.emprendedor.index')
            @include('intranet.propuestas.emprendedor.index')
            @endcan
        </div>
    </div>
@endsection

@section('footer_card')
@endsection

@section('modales')
@endsection

@section('scripts_pagina')

@endsection
