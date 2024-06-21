@section('breadcrumb')
    <li class="breadcrumb-item active">Inicio</li>
@endsection
@section('titulo_card')
Propuestas
@endsection
@section('botones_card')

@endsection
@section('cuerpo')
<div class="row d-flex justify-content-evenly">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info bg-gradient">
            <div class="inner">
                <h3>{{$propuestas->count()}}</h3>
                <p>Cant Propuestas</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            @if ($jurados->count()&&$emprendedores->count())
            <a href="{{route('propuestas.index')}}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a>
            @endif
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success bg-gradient">
            <div class="inner">
                <h3>{{$jurados->count()}}</h3>
                <p>Jurados</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="{{route('jurados.index')}}" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning bg-gradient">
            <div class="inner">
                <h3>{{$emprendedores->count()}}</h3>
                <p>Emprendedores</p>
            </div>
            <div class="icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <a href="{{route('emprendedores.index')}}" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<hr>
<a href="{{route('refrescar.notas')}}" class="btn btn-primary btn-sombra btn-sm pl-5 pr-5">Refrescar Promedio de Notas</a>
<ion-icon name="school-outline"></ion-icon>

@endsection
@section('footer_card')

@endsection
@section('modales')

@endsection
