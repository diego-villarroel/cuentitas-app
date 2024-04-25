<form id="add-servicio" class="row">
    {{ csrf_field() }}
    <div class="input-field col s12 m6">
        <input id="nombre_empresa" name="nombre_empresa" type="text" class="validate">
        <label>Nombre Empresa</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="servicio" name="servicio" type="text" class="validate">
        <label for="valor">Servicio</label>
    </div>
    <div class="input-field col s12 m4 center-align">
        <div class="switch">
            <label>
                AMOR
                <input type="checkbox" id="de_casa" name="de_casa" value="0">
                <span class="lever"></span>
                De Casita
            </label>
        </div>
    </div>
    <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light btn">Agregar</button>
    </div>
</form>
<div id="exito-add-servicio" class="col s12 hide">
    <div class="card">
        <div class="card-content">
            <span class="card-title center-align">Servicio agregado con éxito! Recargando</span>
            <div class="progress" style="margin-top:20px;margin-bottom:20px">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>
</div>