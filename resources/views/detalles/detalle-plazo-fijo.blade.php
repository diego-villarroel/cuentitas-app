<form id="frm-edicion-pf" class="row" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id_detalle_pf">
    <div class="input-field col s12 m6">
        <input name="ingresado" type="text" disabled>
        <label for="ingresado">Monto Ingresado</label>
    </div>
    <div class="input-field col s12 m6">
        <input name="devolver" type="text" disabled>
        <label for="devolver">Monto a Devolver</label>
    </div>
    <div class="input-field col s12">
        <select name="persona" disabled>
            <option value="">Elige una opción</option>
            @foreach ($lista_personas as $pollito)
                <option value="{{$pollito->id_pollito}}">{{$pollito->nombre}} {{$pollito->apellido}}</option>
            @endforeach
        </select>
        <label>Propietario</label>
    </div>
    <div class="input-field col s12 m6">
        <select name="banco" disabled>
            <option value="" disabled selected>Elige una opción</option>
            @foreach ($lista_bancos as $ban)
                <option value="{{$ban->id_bancos}}">{{$ban->nombre}}</option>
            @endforeach
        </select>
        <label>Banco</label>
    </div>
    <div class="input-field col s12 m6">
        <select name="tipo_pf" disabled>
            <option value="" disabled selected>Elige una opción</option>
            @foreach ($tipos_pf as $pf)
                <option value="{{$pf->id_tipo_pf}}">{{$pf->nombre_tipo_pf}}</option>
            @endforeach
        </select>
        <label>Tipo de Plazo Fijo</label>
    </div>
    <div class="input-field col s12 m4">
        <input name="fecha" type="date" disabled>
        <label for="fecha">Fecha de creación</label>
    </div>
    <div class="input-field col s12 m4">
        <input name="dias" type="number" disabled>
        <label for="dias">Días</label>
    </div>
    <div class="input-field col s12 m4 center-align">
        <div class="switch">
            <label>
                Inactivo
                <input type="checkbox" name="activo" value="0" disabled>
                <span class="lever"></span>
                Activo
            </label>
        </div>
    </div>
    <!-- <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light btn">Agregar</button>
    </div> -->
</form>
{{--<div id="exito-add-pf" class="col s12 hide">
    <div class="card">
        <div class="card-content">
            <span class="card-title center-align">Plazo Fijo agregado con éxito! Recargando</span>
            <div class="progress" style="margin-top:20px;margin-bottom:20px">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>
</div>--}}