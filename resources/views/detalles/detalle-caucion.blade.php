<form id="detalle-caucion" class="row">
    {{ csrf_field() }}
    <div class="input-field col s12 m6">
        <input id="ingresado" name="ingresado" type="text" class="validate">
        <label for="ingresado">Monto Ingresado</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="devolver" name="devolver" type="text" class="validate">
        <label for="devolver">Monto a Devolver</label>
    </div>
    <div class="input-field col s12 m12">
        <select id="tipo_pf" name="nombre" id="nombre">
            <option value="" disabled selected>Elige una opción</option>
            @foreach ($lista_personas as $persona)
                <option value="{{$persona->id_pollito}}">{{$persona->nombre}} {{$persona->apellido}}</option>
            @endforeach
        </select>
        <label>Propietario</label>
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
                <input type="checkbox" id="activo-caucion" name="activo" value="0">
                <span class="lever"></span>
                Activo
            </label>
        </div>
    </div>
    <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light btn">Agregar</button>
    </div>
</form>
<div id="exito-add-caucion" class="col s12 hide">
    <div class="card">
        <div class="card-content">
            <span class="card-title center-align">Caución agregada con éxito! Recargando</span>
            <div class="progress" style="margin-top:20px;margin-bottom:20px">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>
</div>