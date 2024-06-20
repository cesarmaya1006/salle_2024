<div class="row">
    <div class="col-12 col-md-3 form-group">
        <label for="rol_id" class="requerido">Rol de Usuario</label>
        <select name="rol" id="rol" class="form-control form-control-sm" {{ isset($usuario_edit) ? 'disabled' : 'required' }}>
            <option value="">Elija un Rol</option>
            @foreach ($roles as $rol)
                <option value="{{ $rol->name }}" {{isset($usuario_edit)?($usuario_edit->hasPermissionTo($rol->name)?'selected':''):''}}>{{ $rol->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-3 form-group">
        <label for="nombre1" class="requerido">Primer Nombre</label>
        <input type="text" class="form-control form-control-sm" id="nombre1" name="nombre1" placeholder="Primer Nombre" value="{{ old('nombre1', $usuario_edit->persona->nombre1 ?? '') }}" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label for="nombre2">Segundo Nombre</label>
        <input type="text" class="form-control form-control-sm" id="nombre2" name="nombre2" placeholder="Segundo Nombre" value="{{ old('nombre2', $usuario_edit->persona->nombre2 ?? '') }}">
    </div>
    <div class="col-12 col-md-3 form-group">
        <label for="apellido1" class="requerido">Primer Apellido</label>
        <input type="text" class="form-control form-control-sm" id="apellido1" name="apellido1" placeholder="Primer Apellido" value="{{ old('apellido1', $usuario_edit->persona->apellido1 ?? '') }}" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label for="apellido2">Segundo Apellido</label>
        <input type="text" class="form-control form-control-sm" id="apellido2" name="apellido2" placeholder="Segundo Apellido" value="{{ old('apellido2', $usuario_edit->persona->apellido2 ?? '') }}">
    </div>
    <div class="col-12 col-md-2 form-group">
        <label for="docutipos_id" class="requerido">Tipo Documento</label>
        <select name="docutipos_id" id="docutipos_id" class="form-control form-control-sm" required>
            <option value="">Tip Docum</option>
            @foreach ($tiposdocu as $tipo_docu)
                <option value="{{ $tipo_docu->id }}" {{isset($usuario_edit)?($tipo_docu->id == $usuario_edit->persona->docutipos_id?'selected':''):''}}>{{ $tipo_docu->abreb_id }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label for="identificacion" class="requerido">N° de Identificación</label>
        <input type="text" class="form-control form-control-sm" id="identificacion" name="identificacion" value="{{ old('identificacion', $usuario_edit->persona->identificacion ?? '') }}" required>
    </div>
    <div class="col-10 col-md-3 form-group">
        <label for="email" class="requerido">Correo Electrónico</label>
        <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{ old('email', $usuario_edit->email ?? '') }}" required>
    </div>
    <div class="col-10 col-md-3 form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" class="form-control form-control-sm" id="telefono" name="telefono" value="{{ old('telefono', $usuario_edit->persona->telefono ?? '') }}">
    </div>
    <div class="col-10 col-md-3 form-group">
        <label for="direccion">Dirección</label>
        <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" value="{{ old('direccion', $usuario_edit->persona->direccion ?? '') }}">
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-5 form-group">
        <label for="foto">Fotografía</label>
        <input type="file" class="form-control form-control-sm" id="foto" name="foto" accept="image/png,image/jpeg" onchange="mostrar_foto()">
    </div>
    <div class="col-12 col-md-4">
        <div class="row d-flex justify-content-center">
            <div class="col-10 col-md-6 p-2" style="border-style: ridge;">
                <img class="img-fluid fotoUsuario" id="fotoUsuario" src="{{ isset($usuario_edit) ? asset('imagenes/usuarios/'.$usuario_edit->persona->foto):asset('imagenes/usuarios/usuario-inicial.jpg') }}" alt="">
            </div>
        </div>
    </div>
</div>
