<form id="add-caucion" class="row">
    {{ csrf_field() }}
    <div class="input-field col s12 m6">
        <input id="ingresado" name="ingresado" type="text" class="validate">
        <label for="ingresado">Monto Ingresado</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="devolver" name="devolver" type="text" class="validate">
        <label for="devolver">Monto a Devolver</label>
    </div>
    <div class="input-field col s12">
        <input id="persona" name="persona" type="text" class="validate">
        <label for="persona">Propietario</label>
    </div>
    <div class="input-field col s12 m6">
        <select id="banco" name="banco">
            <option value="" disabled selected>Elige una opción</option>
            <option value="galicia">Galicia</option>
            <option value="ciudad">Ciudad</option>
            <option value="hipotecario">Hipotecario</option>
            <option value="credicoop">Credicoop</option>
            <option value="nacion">Nación</option>
        </select>
        <label>Banco</label>
    </div>
    <div class="input-field col s12 m6">
        <select id="tipo_pf" name="tipo_pf">
            <option value="" disabled selected>Elige una opción</option>
            <option value="1">Tradicional</option>
            <option value="2">UVA</option>
        </select>
        <label>Tipo de Plazo Fijo</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="fecha" name="fecha" type="date" class="validate">
        <label for="fecha">Fecha de creación</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="dias" name="dias" type="number" class="validate">
        <label for="dias">Días</label>
    </div>
    <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light btn">Agregar</button>
    </div>
</form>