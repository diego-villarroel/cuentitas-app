<form id="frm-edicion-caucion" class="row">
    {{ csrf_field() }}
    <input type="hidden" name="id_caucion">
    <div class="input-field col s12 m6">
        <input name="ingresado" type="text" disabled>
        <label for="ingresado">Monto Ingresado</label>
    </div>
    <div class="input-field col s12 m6">
        <input name="devolver" type="text" disabled>
        <label for="devolver">Monto a Devolver</label>
    </div>
    <div class="input-field col s12 m12">
        <select name="persona" disabled>
            <option value="" selected>Elige una opción</option>
            @foreach ($lista_personas as $persona)
                <option value="{{$persona->id_pollito}}">{{$persona->nombre}} {{$persona->apellido}}</option>
            @endforeach
        </select>
        <label>Propietario</label>
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
        <button type="submit" class="waves-effect waves-light btn">Cambiar</button>
    </div> -->
</form>
{{--<div id="exito-add-caucion" class="col s12 hide">
    <div class="card">
        <div class="card-content">
            <span class="card-title center-align">Caución agregada con éxito! Recargando</span>
            <div class="progress" style="margin-top:20px;margin-bottom:20px">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>
</div>--}}