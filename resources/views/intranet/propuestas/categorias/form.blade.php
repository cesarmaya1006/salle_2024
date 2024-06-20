<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="componente">Categoría Componente</label>
            <input type="text"
                   class="form-control form-control-sm"
                   name="componente"
                   id="componente"
                   aria-describedby="helpId"
                   value="{{ old('componente', $componente_edit->componente ?? '') }}" placeholder="Nombre de categoría"
                   required>
        </div>
    </div>
</div>
