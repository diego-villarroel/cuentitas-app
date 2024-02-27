<form id="add-resumen-tarjeta" class="row">
    {{ csrf_field() }}
    <div class="input-field col s12 m6">
        <select id="tarjeta" name="tarjeta">
            <option value="" disabled selected>Elige una opción</option>
            @foreach ($lista_tarjetas as $tarjeta)
                <option value="{{$tarjeta->id_tarjeta}}">{{$tarjeta->nombre_tarjeta}}</option>
            @endforeach
        </select>
        <label>Tarjeta</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="valor" name="valor" type="text" class="validate">
        <label for="valor">Monto</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="vencimiento" name="vencimiento" type="date" class="validate">
        <label for="vencimiento">Vencimiento</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="corte" name="corte" type="date" class="validate">
        <label for="corte">Corte</label>
    </div>
    <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light btn">Agregar</button>
    </div>
</form>
<div class="row center-align deep-purple lighten-1 hide" id="exito-add-resumen-tarjeta">
    <p class="center-align">Se agrego con éxito la caucion. Redirigiendo...</p>
    <div class="col s6">
        <div class="progress">
            <div class="indeterminate"></div>
        </div>
    </div>
</div>