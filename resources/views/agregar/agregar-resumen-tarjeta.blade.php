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
        <small class="grey-text">(Punto para separar centavos solamente)</small><br>
        <small id="error_mora" class="red-text d-none"></small>
    </div>
    <div class="input-field col s12 m6">
        <input id="vencimiento" name="vencimiento" type="date" class="validate">
        <label for="vencimiento">Vencimiento</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="corte" name="corte" type="date" class="validate">
        <label for="corte">Corte</label>
        <small class="grey-text">(Del periodo en curso)</small>
    </div>
    <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light purple darken-4 btn" id="btn-add-res-tarj">Agregar</button>
    </div>
</form>