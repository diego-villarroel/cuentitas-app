<form id="add-caucion" class="row">
    {{ csrf_field() }}
    <div class="input-field col s12 m6">
        <input id="nombre_inversion" name="nombre_inversion" type="text" class="validate">
        <label for="nombre_inversion">Nombre</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="valor" name="valor" type="text" class="validate">
        <label for="valor">Valor total de compra</label>
    </div>
    <div class="input-field col s12">
        <input id="persona" name="persona" type="text" class="validate">
        <label for="persona">Propietario</label>
    </div>
    <div class="input-field col s12 m6">
        <select id="tipo_inv" name="tipo_inv" class="validate">
            <option value="" disabled selected>Elige una opción</option>
            <option value="cedear">CEDEAR</option>
            <option value="on">Obligación Negociable</option>
            <option value="bono">Bono</option>
            <option value="letra">Letra</option>
            <option value="fi">Fondos de Inversiones</option>
        </select>
        <label>Tipo de Inversión</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="representa" name="representa" type="text" class="validate">
        <label for="representa">Empresa/Entidad</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="cantidad" name="cantidad" type="number">
        <label for="cantidad">Cantidad</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="descripcion" name="descripcion" type="text" class="validate">
        <label for="descripcion">Descripción</label>
    </div>
    <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light btn">Agregar</button>
    </div>
</form>