@extends('intranet.layout.app')
@section('css_pagina')
@endsection
@section('titulo_pagina')
<i class="mdi mdi-view-dashboard" aria-hidden="true"></i>    DashBoard - {{session('rol_principal_id')}}
@endsection

@if (session('rol_principal_id') < 3)
    @include('intranet.index.indexadmin')
@endif
@if (session('rol_principal_id') == 3)
    @include('intranet.index.indexjurado')
@endif
@if (session('rol_principal_id') == 4)
    @include('intranet.index.indexemprendedor')
@endif

