<div class="row d-flex justify-content-evenly">
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-info" style="box-shadow: 5px 5px 3px 0px rgba(0,0,0,0.75);">
            <div class="inner">
                <h3>{{$propuestas->count()}}</h3>
                <p>Cant Propuestas</p>
            </div>
            <i class="fas fa-project-diagram small-box-icon"></i>
            <a href="{{route('propuestas.propuestas')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                Ver <i class="bi bi-link-45deg"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-success" style="box-shadow: 5px 5px 3px 0px rgba(0,0,0,0.75);">
            <div class="inner">
                <h3>{{$jurados->count()}}</h3>
                <p>Jurados</p>
            </div>
            <i class="fas fa-chalkboard-teacher small-box-icon"></i>
            <a href="{{route('jurados.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                Administrar <i class="bi bi-link-45deg"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-warning" style="box-shadow: 5px 5px 3px 0px rgba(0,0,0,0.75);">
            <div class="inner">
                <h3>{{$emprendedores->count()}}</h3>
                <p>Emprendedores</p>
            </div>
            <i class="fas fa-graduation-cap small-box-icon"></i>
            <a href="{{route('emprendedores.index')}}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                Administrar <i class="bi bi-link-45deg"></i>
            </a>
        </div>
    </div>
</div>
<hr>
<a href="{{route('refrescar.notas')}}" class="btn btn-primary btn-sm btn-sombra btn-sm pl-5 pr-5" style="box-shadow: 5px 5px 3px 0px rgba(0,0,0,0.75);">Refrescar Promedio de Notas</a>
<ion-icon name="school-outline"></ion-icon>
