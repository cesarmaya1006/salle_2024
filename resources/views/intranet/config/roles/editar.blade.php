@extends('intranet.layouts.app')
@section('css_pagina')
@endsection
@section('titulo_pagina')
    Dashboard
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard v1</li>
@endsection
@section('titulo_card')
Titulo de la tarjeta
@endsection
@section('botones_card')
    <a href="#" class="btn btn-success btn-sm btn-xs btn-sombra pl-3 pr-3 float-md-end">
        <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
        Nuevo registro
    </a>
    <a href="#" class="btn btn-info btn-sm btn-xs btn-sombra pl-3 pr-3 float-md-end">
        <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
        Nuevo registro 2
    </a>
@endsection
@section('cuerpo')
    <div class="row">
        <div class="col-12">
            <h4>Cuerpo de la pagina</h4>
        </div>
    </div>
@endsection
@section('footer_card')

@endsection
@section('modales')

@endsection
