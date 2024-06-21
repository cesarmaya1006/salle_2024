<div class="row d-flex justify-content-center">
    <input type="hidden" name="personas_id" value="{{ session('id_usuario') }}">
    <input type="hidden" name="propuestas_id" value="{{ $usuario->propuesta->id }}">
    <div class="col-12 col-md-7">
        <div class="form-group">
            <label for="descripcion" class="requerido">Descripción de la propuesta</label>
            <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" cols="30" rows="3"
                maxlength="260" required data_nombre="Descripción de la propuesta">{{ $propuesta->descripcion ?? 'Hay muchas variaciones de los pasajes de Lorem Ipsum disponibles' }}</textarea>
            <small id="helpId" class="form-text text-muted">Maximo 30 palabras</small>
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="form-group">
            <label class="requerido" for="informe">Documento Final Propuesta de Negocio</label>
            <input type="file" class="form-control form-control-sm" name="informe" id="informe"
                data_nombre="Documento Final Propuesta de Negocio" aria-describedby="helpId" accept="application/pdf"
                required>
            <small id="helpId" class="form-text text-muted">Archivo en PDF unicamente</small>
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="form-group">
            <label for="descripcion" class="requerido">Sector Socio - Económico</label>
            <select class="form-control form-control-sm" name="sector" id="sector" required
                data_nombre="Sector Socio - Económico">
                <option value="">Seleccione</option>
                <option value="Agricultura y ganadería">Agricultura y ganadería</option>
                <option value="Industrias manufactureras">Industrias manufactureras</option>
                <option value="Productos y servicios para mascotas ">Productos y servicios para mascotas </option>
                <option value="Comercio al por menor en establecimientos">Comercio al por menor en establecimientos
                </option>
                <option
                    value="Comercio al por menor de computadores, equipos periféricos, programas de informática y equipos de telecomunicaciones">
                    Comercio al por menor de computadores, equipos periféricos, programas de informática y equipos de
                    telecomunicaciones</option>
                <option
                    value="Comercio al por menor de libros, periódicos, materiales y artículos de papelería y escritorio">
                    Comercio al por menor de libros, periódicos, materiales y artículos de papelería y escritorio
                </option>
                <option value="Productos y servicios alimenticios ">Productos y servicios alimenticios </option>
                <option value="Información y comunicaciones actividades inmobiliarias">Información y comunicaciones
                    actividades inmobiliarias</option>
                <option value="Actividades profesionales y técnicas">Actividades profesionales y técnicas</option>
                <option value="Actividades de la salud humana">Actividades de la salud humana</option>
                <option
                    value="Actividades artísticas, de entretenimiento y recreación y otras actividades de servicios">
                    Actividades artísticas, de entretenimiento y recreación y otras actividades de servicios</option>
                <option value="Servicios gráficos digitales">Servicios gráficos digitales</option>
                <option value="Artesanías">Artesanías</option>
                <option value="Otro">Otro</option>

            </select>
            <small id="helpId" class="form-text text-muted">Sector Socio - Económico</small>
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="descripcion" class="requerido">Años de experiencia y/o antiguedad</label>
                    <select class="form-control form-control-sm" name="annos" id="annos" required
                        data_nombre="Años de experiencia">
                        <option value="">Seleccione</option>
                        <option value="1">1 año</option>
                        @for ($i = 2; $i < 25; $i++)
                            <option value="{{ $i }}">{{ $i }} años</option>
                        @endfor
                    </select>
                    <small id="helpId" class="form-text text-muted">Experiencia en años</small>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="descripcion" class="requerido">Meses de experiencia y/o antiguedad</label>
                    <select class="form-control form-control-sm" name="meses" id="meses" required
                        data_nombre="Meses de experiencia">
                        <option value="0">0</option>
                        @for ($i = 1; $i < 13; $i++)
                            <option value="{{ $i }}">{{ $i }} meses</option>
                        @endfor
                    </select>
                    <small id="helpId" class="form-text text-muted">Experiencia en meses</small>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row mt-3 mb-3">
    <div class="col-12">
        <h4>Componentes de la propuesta</h4>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="accordion accordion accordion-flush" id="accordionPanelsStayOpenExample">
            @foreach ($componentes as $componente)
                <div class="accordion-item" id="accordion_item_{{ $componente->id }}">
                    <h2 class="accordion-header" id="panelsStayOpen-heading_{{ $componente->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapse_{{ $componente->id }}" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapse_{{ $componente->id }}"
                            id="btn_{{ $componente->id }}">
                            <h5><strong>{{ $componente->componente }}</strong></h5>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapse_{{ $componente->id }}" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-heading_{{ $componente->id }}"
                        data-bs-parent="#accordionPanelsStayOpenExample">
                        <div class="accordion-body">
                            <div class="row">
                                @foreach ($componente->sub_componentes as $sub_componente)
                                    <div class="col-12 card card-outline card-warning mini_sombra">
                                        <div class="card-header">
                                            <h6 class="card-title">
                                                <strong>{{ $sub_componente->sub_componente }}</strong></h6>
                                        </div>
                                        <div class="card-body">
                                            @if (   $sub_componente->sub_componente != 'Canvas' &&
                                                    $sub_componente->sub_componente != 'Video' &&
                                                    $sub_componente->sub_componente != 'Propuesta de cofinanciamiento')
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="sustentacion" class="requerido">Sustentación
                                                                del componente</label>
                                                            <textarea class="form-control form-control-sm" name="sustentacion[]"
                                                                data_nombre="Sustentación  de {{ $sub_componente->sub_componente }}" id="sustentacion_{{ $sub_componente->id }}"
                                                                cols="30" rows="5"data_name_simp="{{ $sub_componente->sub_componente }}"
                                                                data_name="Sustentacion {{ $sub_componente->sub_componente }}" required>Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño.</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-12 mb-3" style="border-bottom: 1px solid black">
                                                        <h6><strong>Archivos adjuntos del componente</strong>
                                                            (Opcionales)</h6>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 mb-3">
                                                                <a class="btn btn-warning btn-xs btn-sombra pl-2 pr-2 agregar_pdf"
                                                                    data_comp="{{ $sub_componente->id }}"><i
                                                                        class="fa fa-plus-circle mr-2 ml-1"
                                                                        aria-hidden="true"></i>Agregar PDF</a>
                                                            </div>
                                                            <div class="col-12 cajas_pdfs"
                                                                id="cajas_pdfs{{ $sub_componente->id }}"
                                                                style="background-color: rgba(196, 200, 238, 0.404)">
                                                                <div class="caja_pdf mt-2 caja_ini_pdf_gen{{ $sub_componente->id }}"
                                                                    id="caja_pdf_{{ $sub_componente->id }}_0">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="pdf_{{ $sub_componente->id }}_0">Archivo
                                                                            0</label>
                                                                        <input type="file"
                                                                            class="form-control form-control-sm"
                                                                            name="pdf[{{ $sub_componente->id }}][]"
                                                                            id="pdf_{{ $sub_componente->id }}_0"
                                                                            aria-describedby="helpId"
                                                                            accept="application/pdf">
                                                                        <small id="helpId"
                                                                            class="form-text text-muted">Archivo en PDF
                                                                            unicamente</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-12 mb-3">
                                                                <a class="btn btn-warning btn-xs btn-sombra pl-2 pr-2 agregar_imagen"
                                                                    data_comp="{{ $sub_componente->id }}"><i
                                                                        class="fa fa-plus-circle mr-2 ml-1"
                                                                        aria-hidden="true"></i>Agregar Imagen</a>
                                                            </div>
                                                            <div class="col-12 cajas_imagenes"
                                                                id="cajas_imagenes{{ $sub_componente->id }}"
                                                                style="background-color: rgba(196, 200, 238, 0.404)">
                                                                <div class="caja_imagen mt-2 caja_ini_imagen_gen{{ $sub_componente->id }}"
                                                                    id="caja_imagen_{{ $sub_componente->id }}_0">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="imagen_{{ $sub_componente->id }}_0">Imagen
                                                                            0</label>
                                                                        <input type="file"
                                                                            class="form-control form-control-sm"
                                                                            name="imagen[{{ $sub_componente->id }}][]"
                                                                            id="imagen_{{ $sub_componente->id }}_0"
                                                                            aria-describedby="helpId"
                                                                            accept="image/png,image/jpeg">
                                                                        <small id="helpId"
                                                                            class="form-text text-muted">Archivos de
                                                                            imagen unicamente</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @if ($sub_componente->sub_componente == 'Canvas')
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-group">
                                                                <label class="requerido" for="canvas">Subir
                                                                    Canvas</label>
                                                                <input type="file"
                                                                    class="form-control form-control-sm"
                                                                    name="canvas" data_nombre="Canvas"
                                                                    id="canvas_{{ $sub_componente->id }}"
                                                                    aria-describedby="helpId" accept="application/pdf"
                                                                    required>

                                                                <small id="helpId"
                                                                    class="form-text text-muted">Archivo en PDF
                                                                    unicamente</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($sub_componente->sub_componente == 'Video')
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="requerido" for="video">Subir url
                                                                    video</label>
                                                                <input type="text"
                                                                    class="form-control form-control-sm"
                                                                    name="video" data_nombre="Video"
                                                                    id="video_{{ $sub_componente->id }}"
                                                                    aria-describedby="helpId" value="https://www.youtube.com/watch?v=cx5qVmtfayA" required>
                                                                <small id="helpId"
                                                                    class="form-text text-muted">Subir la url del
                                                                    video</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($sub_componente->sub_componente == 'Propuesta de cofinanciamiento')
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="requerido" for="excel">Subir propuesta en Excel </label>
                                                                <input type="file" class="form-control form-control-sm" name="excel" id="excel_{{$sub_componente->id}}" aria-describedby="helpId" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                                                <small id="helpId"
                                                                    class="form-text text-muted">Archivo en Excel
                                                                    unicamente xls ó xlsx</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-12 mb-3"
                                                            style="border-bottom: 1px solid black">
                                                            <h6><strong>Agregar Cotizaciones</strong> (Opcionales)</h6>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-12 mb-3">
                                                                    <a class="btn btn-warning btn-xs btn-sombra pl-2 pr-2 agregar_pdf"
                                                                        data_comp="{{ $sub_componente->id }}"><i
                                                                            class="fa fa-plus-circle mr-2 ml-1"
                                                                            aria-hidden="true"></i>Agregar Cotización
                                                                        en PDF</a>
                                                                </div>
                                                                <div class="col-12 cajas_pdfs"
                                                                    id="cajas_pdfs{{ $sub_componente->id }}"
                                                                    style="background-color: rgba(196, 200, 238, 0.404)">
                                                                    <div class="caja_pdf mt-2 caja_ini_pdf_gen{{ $sub_componente->id }}"
                                                                        id="caja_pdf_{{ $sub_componente->id }}_0">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="pdf_{{ $sub_componente->id }}_0">Archivo
                                                                                0</label>
                                                                            <input type="file"
                                                                                class="form-control form-control-sm"
                                                                                name="pdf[{{ $sub_componente->id }}][]"
                                                                                id="pdf_{{ $sub_componente->id }}_0"
                                                                                aria-describedby="helpId"
                                                                                accept="application/pdf">
                                                                            <small id="helpId"
                                                                                class="form-text text-muted">Archivo en
                                                                                PDF unicamente</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
