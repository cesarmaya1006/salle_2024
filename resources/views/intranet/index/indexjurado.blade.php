@section('breadcrumb')
    <li class="breadcrumb-item active">Inicio</li>
@endsection
@section('titulo_card')
Propuestas Asignadas Primera Fase
@endsection
@section('botones_card')

@endsection
@section('cuerpo')
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped table-hover table-sm tabla_data_table_xs tabla-borrando" id="tabla-data">
            <thead class="thead-inverse">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Estado Calificación 1era Fase</th>
                    <th class="text-center">Emprendedor</th>
                    <th class="text-center">Titulo</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Total Componentes</th>
                    <th class="text-center">Componentes Calificados</th>
                    <th class="width70"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuario->persona->propuestas_j as $propuesta)
                    @php
                        $cantComponentes = $propuesta->componentesFaseUno->count();
                        $cantCalificado = 0;
                    @endphp
                    @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                        @php
                            $cantCalificado += $componenteFaseUno->notas->where('personas_id', session('id_usuario'))->count();
                            $componenteCalificado = 0;
                        @endphp
                        @foreach ($componenteFaseUno->notas as $nota)
                            @php
                                if ($nota->prim_fase_componentes_id === $componenteFaseUno->id && $nota->prim_fase_componentes_id === $usuario->id) {
                                    $componenteCalificado++;
                                }
                            @endphp
                        @endforeach
                    @endforeach
                    @php
                        $porcentajeCalificado = ($cantCalificado * 100) / $cantComponentes;
                        $porcentajeCalificado_2 = number_format(($cantCalificado * 100) / $cantComponentes, 2, ',', '.');
                    @endphp
                    <tr>
                        <td class="text-center">{{ $propuesta->id }}</td>
                        <td class="text-center">
                            @if ($porcentajeCalificado === 0)
                                <span class="badge bg-danger w-100">Propuesta sin
                                    calificar</span>
                                <p class="mt-2"><strong>0.0%</strong></p>
                            @else
                                <div class="progress w-100">
                                    <div class="progress-bar {{ $porcentajeCalificado <= 25 ? 'bg-danger' : ($porcentajeCalificado <= 50 ? 'bg-warning' : ($porcentajeCalificado <= 75 ? 'bg-info' : ($porcentajeCalificado <= 99 ? 'bg-primary' : 'bg-success'))) }}"
                                        role="progressbar"
                                        style="width: {{ $porcentajeCalificado }}%;"
                                        aria-valuenow="{{ $porcentajeCalificado }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                        {{ $porcentajeCalificado_2 }}%
                                    </div>
                                </div>
                                <p class="mt-2">
                                    <strong>{{ $porcentajeCalificado_2 }}%</strong></p>
                            @endif
                        </td>
                        <td class="text-center">{{ $propuesta->emprendedor->nombre1 }}
                            {{ $propuesta->emprendedor->nombre2 != null ? ' ' . $propuesta->emprendedor->nombre2 : '' }}
                            {{ ' ' . $propuesta->emprendedor->apellido1 }}
                            {{ $propuesta->emprendedor->apellido != null ? ' ' . $propuesta->emprendedor->apellido : '' }}
                        </td>
                        <td class="text-center">{{ $propuesta->titulo }}</td>
                        <td class="text-center">{{ $propuesta->descripcion ?? '' }}</td>
                        <td class="text-center">{{ $propuesta->componentesFaseUno->Count() }}
                        </td>
                        <td class="text-center">{{ $cantCalificado }}</td>
                        <td>
                            @if ($propuesta->componentesFaseUno->Count() != $cantCalificado)
                                <a href="{{ route('jurados.calificar_primera_fase', ['id' => $propuesta->id]) }}"
                                    class="btn btn-warning bg-gradient btn-sombra btn-xs pl-3 pr-3 ml-3"><i
                                        class="fas fa-chalkboard-teacher"></i> Calificar primera
                                    fase</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped table-hover table-sm tabla_data_table_xs tabla-borrando" id="tabla-data">
            <thead class="thead-inverse">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Estado Calificación 2da Fase</th>
                    <th class="text-center">Emprendedor</th>
                    <th class="text-center">Titulo</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Total Componentes</th>
                    <th class="text-center">Componentes Calificados</th>
                    <th class="text-center">Calificación</th>
                    <th class="width70"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuario->persona->propuestas_j_dos as $propuesta)
                    @php
                        $cantComponentes = $propuesta->componentesFaseDos->count();
                        $cantCalificado = 0;
                    @endphp
                    @foreach ($propuesta->componentesFaseDos as $componenteFaseDos)
                        @php
                            $cantCalificado += $componenteFaseDos->notas->where('personas_id', session('id_usuario'))->count();
                            $componenteCalificado = 0;
                        @endphp
                        @foreach ($componenteFaseDos->notas as $nota)
                            @php
                                if ($nota->seg_fase_componentes_id == $componenteFaseDos->id && $nota->personas_id === $usuario->persona->id) {
                                    $componenteCalificado++;
                                }
                            @endphp
                        @endforeach
                    @endforeach
                    @php
                        $porcentajeCalificado = ($cantCalificado * 100) / $cantComponentes;
                        $porcentajeCalificado_2 = number_format(($cantCalificado * 100) / $cantComponentes, 2, ',', '.');
                    @endphp
                    <tr>
                        <td class="text-center">{{ $propuesta->id }}</td>
                        <td class="text-center">
                            @if ($porcentajeCalificado === 0)
                                <span class="badge bg-danger w-100">Propuesta sin
                                    calificar</span>
                                <p class="mt-2"><strong>0.0%</strong></p>
                            @else
                                <div class="progress w-100">
                                    <div class="progress-bar {{ $porcentajeCalificado <= 25 ? 'bg-danger' : ($porcentajeCalificado <= 50 ? 'bg-warning' : ($porcentajeCalificado <= 75 ? 'bg-info' : ($porcentajeCalificado <= 99 ? 'bg-primary' : 'bg-success'))) }}"
                                        role="progressbar"
                                        style="width: {{ $porcentajeCalificado }}%;"
                                        aria-valuenow="{{ $porcentajeCalificado }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                        {{ $porcentajeCalificado_2 }}%
                                    </div>
                                </div>
                                <p class="mt-2">
                                    <strong>{{ $porcentajeCalificado_2 }}%</strong></p>
                            @endif
                        </td>
                        <td class="text-center">{{ $propuesta->emprendedor->nombre1 }}
                            {{ $propuesta->emprendedor->nombre2 != null ? ' ' . $propuesta->emprendedor->nombre2 : '' }}
                            {{ ' ' . $propuesta->emprendedor->apellido1 }}
                            {{ $propuesta->emprendedor->apellido != null ? ' ' . $propuesta->emprendedor->apellido : '' }}
                        </td>
                        <td class="text-center">{{ $propuesta->titulo }}</td>
                        <td class="text-center">{{ $propuesta->descripcion ?? '' }}</td>
                        <td class="text-center">{{ $propuesta->componentesFaseDos->Count() }}
                        </td>
                        <td class="text-center">{{ $cantCalificado }}</td>
                        @php
                            $sumNotas =0;
                        @endphp
                        @foreach ($propuesta->componentesFaseDos as $componenteFaseDos)
                            @php
                                $sumNotas += $componenteFaseDos->notas->where('personas_id',session('id_usuario'))->sum('calificacion');
                            @endphp
                        @endforeach
                        <td class="text-center">{{ number_format($sumNotas/$propuesta->componentesFaseDos->count(),'4','.',',') }}</td>

                        <td>
                            @if ($propuesta->componentesFaseDos->Count() != $cantCalificado)
                                <a href="{{ route('jurados.calificar_segunda_fase', ['id' => $propuesta->id]) }}"
                                    class="btn btn-warning bg-gradient btn-sombra btn-xs pl-3 pr-3 ml-3"><i
                                        class="fas fa-chalkboard-teacher"></i> Calificar segunda fase</a>
                            @endif
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

@endsection
