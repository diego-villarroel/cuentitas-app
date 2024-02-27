<form id="add-factura" class="row">
    {{ csrf_field() }}
    <div class="input-field col s12 m6">
        <select id="tipo_servicio" name="tipo_servicio">
            <option value="" disabled selected>Elige una opción</option>
            <option value="telemientp">Telemiento</option>
            <option value="edesur">Edesur</option>
            <option value="agip">Agip</option>
            <option value="aysa">Aysa</option>
            <option value="metrogas">Metrogas</option>
            <option value="supercanal">Supercanal</option>
            <option value="alquiler">Alquiler</option>
            <option value="expensas">Expensas</option>
        </select>
        <label>Empresa/Servicio</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="valor" name="valor" type="text" class="validate">
        <label for="valor">Valor</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="vencimiento1" name="vencimiento1" type="date" class="validate">
        <label for="vencimiento1">Primer vencimiento</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="vencimiento2" name="vencimiento2" type="date">
        <label for="vencimiento2">Segundo vencimiento</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="valor-mora" name="valor-mora" type="text" class="validate">
        <label for="valor-mora">Valor con Mora</label>
    </div>
    <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light btn">Agregar</button>
    </div>
</form>