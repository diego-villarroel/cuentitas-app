<form id="add-gasto-presupuesto" class="row">
    {{ csrf_field() }}
    <!-- DESDE PRESU -->
    <div id="seccion_presu" class="d-none">
        <input type="hidden" id="id_presu_select" name="id_presu_select">
        <div class="input-field col s12">
            <input type="text" class="validate" id="nombre_presu_select" placeholder="Presupuesto" name="nombre_presu_select">
            <label>Presupuesto</label>
        </div>
    </div>

    <!-- DESDE INICIO -->
    <div id="seccion_inicio">
        <div class="input-field col s12">
            <select id="presu_gasto" name="presu_gasto">
                <option value="" disabled selected>Elige una opción</option>
                @foreach( $presupuestos as $pres)
                    <option value="{{ $pres->id_presupuesto }}">{{ $pres->nombre_presupuesto }}</option>
                @endforeach
            </select>
            <label>Presupuesto</label>
        </div>
    </div>
    <div class="input-field col s12 m6">
        <input id="nombre" name="nombre" type="text" class="validate">
        <label for="nombre">Nombre del Gasto</label>
    </div>
    <div class="input-field col s12 m6">
        <input id="valor" name="valor" type="text" class="validate" placeholder="$">
        <label for="valor">Gasto</label>
        <small class="grey-text">(Punto para separar centavos solamente)</small><br>
        <small id="error_valor" class="red-text d-none"></small>
    </div>
    
    <div class="col s12 right-align">
        <button type="submit" class="waves-effect waves-light purple darken-4 btn">Agregar</button>
    </div>
</form>