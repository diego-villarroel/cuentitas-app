<form id="add-caucion" class="row">
    {{ csrf_field() }}
    <div class="input-field col s12 m6">
        <select id="tipo_servicio" name="tipo_servicio">
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
        <input id="vencimiento1" name="vencimiento1" type="date" class="validate">
        <label for="vencimiento1">Vencimiento</label>
    </div>
    <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light btn">Agregar</button>
    </div>
</form>