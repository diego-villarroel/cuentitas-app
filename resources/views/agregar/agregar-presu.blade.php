<form id="add-presupuesto" class="row">
    {{ csrf_field() }}
    <div class="input-field col s12 m6">
        <select id="tipo_presupuesto" name="tipo_presupuesto">
            <option value="" disabled selected>Elige una opción</option>
            @foreach( $tipos_presupuestos as $tp)
                <option value="{{ $tp->id_tipo_presupuesto }}">{{ $tp->nombre_tipo_presupuesto }} {{ $tp->icono }}</option>
            @endforeach
        </select>
        <label>Tipo Presupuesto</label>
    </div>
    <div class="input-field col s12 m6">
        <select id="mes" name="mes">
            <option value="" disabled selected>Elige una opción</option>
            <option value="1" data-mes="ENERO">Enero</option>
            <option value="2" data-mes="FEBRERO">Febrero</option>
            <option value="3" data-mes="MARZO">Marzo</option>
            <option value="4" data-mes="ABRIL">Abril</option>
            <option value="5" data-mes="MAYO">Mayo</option>
            <option value="6" data-mes="JUNIO">Junio</option>
            <option value="7" data-mes="JULIO">Julio</option>
            <option value="8" data-mes="AGOSTO">Agosto</option>
            <option value="9" data-mes="SEPTIEMBRE">Septiembre</option>
            <option value="10" data-mes="OCTUBRE">Octubre</option>
            <option value="11" data-mes="NOVIEMBRE">Noviembre</option>
            <option value="12" data-mes="DICIEMBRE">Diciembre</option>
        </select>
        <label>Mes</label>
    </div>
    <input type="hidden" name="mes_string" id="mes_string">
    <div class="input-field col s12 m6">
        <input id="nombre" name="nombre" type="text" class="validate">
        <label for="nombre">Nombre Presupuesto</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="valor" name="valor" type="text" class="validate" placeholder="$">
        <label for="valor">Monto</label>
    </div>
    
    <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light purple darken-4 btn">Agregar</button>
    </div>
</form>