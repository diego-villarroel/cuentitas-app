<form id="add-factura" class="row">
    {{ csrf_field() }}
    <div class="input-field col s12 m6">
        <select id="servicio" name="servicio">
            <option value="" disabled selected>Elige una opción</option>
            @foreach ($lista_servicios as $serv)
            <option value="{{$serv->id_servicio}}">{{$serv->nombre_servicio}} - {{$serv->servicio}}</option>
            @endforeach
        </select>
        <label>Empresa/Servicio</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="valor" name="valor" type="text" class="validate">
        <label for="valor">Valor</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="vencimiento_1" name="vencimiento_1" type="date" class="validate">
        <label for="vencimiento_1">Primer vencimiento</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="vencimiento_2" name="vencimiento_2" type="date">
        <label for="vencimiento_2">Segundo vencimiento</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="valor_mora" name="valor_mora" type="text" class="validate">
        <label for="valor_mora">Valor con Mora</label>
    </div>
    <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light btn">Agregar</button>
    </div>
</form>
<div id="exito-add-factura" class="col s12 hide">
    <div class="card">
        <div class="card-content">
            <span class="card-title center-align">Factura agregada con éxito! Recargando</span>
            <div class="progress" style="margin-top:20px;margin-bottom:20px">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>
</div>