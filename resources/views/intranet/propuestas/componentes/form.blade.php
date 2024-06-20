<div class="row">
    <div class="col-12 col-md-3 form-group">
        <label for="componente_id">Categoría Componente</label>
        <select class="form-control form-control-sm" name="componente_id" id="componente_id">
            <option value="">---Seleccione---</option>
            @foreach ($componentes as $componente)
                <option value="{{ $componente->id }}" {{ isset($subcomponente_edit) ? ($componente->id == $subcomponente_edit->componente_id ? 'selected' : '') : '' }}>
                    {{ $componente->componente }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label for="sub_componente">Componente</label>
        <input type="text" class="form-control form-control-sm" name="sub_componente" id="sub_componente" aria-describedby="helpId"
            value="{{ old('sub_componente', $subcomponente_edit->sub_componente ?? '') }}" placeholder="Nombre de cargo" required>
    </div>
</div>
