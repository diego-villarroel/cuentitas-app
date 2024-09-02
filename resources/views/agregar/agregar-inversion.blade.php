<form id="add-inversion" class="row">
    {{ csrf_field() }}
    <div class="input-field col s12 m6">
        <input id="nombre_inversion" name="nombre_inversion" type="text" class="validate">
        <label for="nombre_inversion">Nombre</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="valor_total" name="valor_total" type="text" placeholder="$">
        <label for="valor_total">Valor total de compra</label>
        <small class="grey-text">(Punto para separar centavos solamente)</small><br>
        <small id="error_valor_total" class="red-text d-none"></small>
    </div>
    <div class="input-field col s12 m6">
        <input id="empresa" name="empresa" type="text">
        <label for="empresa">Empresa/Entidad</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="cantidad" name="cantidad" type="number">
        <label for="cantidad">Cantidad</label>
    </div>
    <div class="input-field col s12 m6">
        <select id="persona" name="persona" class="validate">
            <option value="" disabled selected>Elige una opción</option>
            @foreach ( $lista_personas as $per) 
                <option value="{{$per->id_pollito}}">{{$per->nombre}} {{$per->apellido}}</option>
            @endforeach
        </select>
        <label for="persona">Propietario</label>
    </div>
    <div class="input-field col s12 m6">
        <select id="tipo_inv" name="tipo_inv" class="validate">
            <option value="" disabled selected>Elige una opción</option>
            @foreach ($tipo_inversiones as $tp)
                <option value="{{$tp->id_tipo_inversion}}">{{$tp->nombre_tipo_inversion}}</option>
            @endforeach
        </select>
        <label>Tipo de Inversión</label>
    </div>
    <div class="input-field col s12">
        <input id="descripcion" name="descripcion" type="text" class="validate">
        <label for="descripcion">Descripción</label>
    </div>
    <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light purple darken-4 btn" id="btn-add-inversion">Agregar</button>
    </div>
</form>