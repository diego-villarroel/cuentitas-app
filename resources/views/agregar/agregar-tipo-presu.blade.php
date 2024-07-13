<form id="add-tipo-presu" class="row">
    {{ csrf_field() }}
    <div class="input-field col s10">
        <input id="tipo_presu" name="tipo_presu" type="text" class="validate">
        <label for="tipo_presu">Nombre Tipo Presupuesto</label>
    </div>
    <div class="input-field col s2">
        <input id="icono" name="icono" type="text" class="validate">
        <label for="icono">Ícono</label>
    </div>
    <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light purple darken-4 btn">Agregar</button>
    </div>
</form>