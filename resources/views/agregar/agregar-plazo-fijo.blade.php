<form id="add-plazo-fijo" class="row" method="post">
    {{ csrf_field() }}
    <input type="hidden">
    <div class="input-field col s12 m6">
        <input id="ingresado" name="ingresado" type="text" class="validate">
        <label for="ingresado">Monto Ingresado</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="devolver" name="devolver" type="text" class="validate">
        <label for="devolver">Monto a Devolver</label>
    </div>
    <div class="input-field col s12">
        <select id="persona" name="persona">
            <option value="" disabled selected>Elige una opción</option>
            @foreach ($lista_personas as $pollito)
                <option value="{{$pollito->id_pollito}}">{{$pollito->nombre}} {{$pollito->apellido}}</option>
            @endforeach
        </select>
        <label>Propietario</label>
        <!-- <input id="persona" name="persona" type="text" class="validate">
        <label for="persona">Propietario</label> -->
    </div>
    <div class="input-field col s12 m6">
        <select id="banco" name="banco">
            <option value="" disabled selected>Elige una opción</option>
            @foreach ($lista_bancos as $ban)
                <option value="{{$ban->id_bancos}}">{{$ban->nombre}}</option>
            @endforeach
        </select>
        <label>Banco</label>
    </div>
    <div class="input-field col s12 m6">
        <select id="tipo_pf" name="tipo_pf">
            <option value="" disabled selected>Elige una opción</option>
            @foreach ($tipos_pf as $pf)
                <option value="{{$pf->id_tipo_pf}}">{{$pf->nombre_tipo_pf}}</option>
            @endforeach
        </select>
        <label>Tipo de Plazo Fijo</label>
    </div>
    <div class="input-field col s12 m4">
        <input id="fecha" name="fecha" type="date" class="validate">
        <label for="fecha">Fecha de creación</label>
    </div>
    <div class="input-field col s12 m4">
        <input id="dias" name="dias" type="number" class="validate">
        <label for="dias">Días</label>
    </div>
    <div class="input-field col s12 m4 center-align">
        <div class="switch">
            <label>
                Inactivo
                <input type="checkbox" id="activo-plazo-fijo" name="activo" value="0">
                <span class="lever"></span>
                Activo
            </label>
        </div>
    </div>
    <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light btn">Agregar</button>
    </div>
</form>
<div class="deep-purple lighten-1 hide" id="exito-add-pf">
    <p class="center-align">Se agrego con éxito el Plazo Fijo. Redirigiendo...</p>
    <div class="progress">
        <div class="indeterminate"></div>
    </div>
</div>