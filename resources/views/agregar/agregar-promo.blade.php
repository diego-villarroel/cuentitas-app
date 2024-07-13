
<form id="add-promocion">
    {{ csrf_field() }}
    <div class="row">
        <div class="input-field col s12 m6">
            <input id="nombre" name="nombre" type="text" class="validate">
            <label for="nombre">Tienda</label>
        </div>
        <div class="input-field col s12 m6">
            <select id="presu_gasto" name="presu_gasto">
                <option value="">Elige una opción</option>
                @foreach ( $lista_bancos as $banco)
                    <option value="{{ $banco->id_bancos }}">{{ $banco->nombre}}</option>
                @endforeach
            </select>
            <label>Banco</label>
        </div>
        <div class="input-field col s12 m6">
            <select id="presu_gasto" name="presu_gasto">
                <option value="">Elige una opción</option>
                <option value="R">Reintegro</option>
                <option value="D">Descuento</option>
            </select>
            <label>Tipo de Promo</label>
        </div>
        <div class="input-field col s12 m6">
            <select id="presu_gasto" name="presu_gasto">
                <option value="">Elige una opción</option>
                <option value="MP">MercadoPago</option>
                <option value="MO">Modo</option>
                <option value="NX">NaranjaX</option>
                <option value="MF">Morfy</option>
            </select>
            <label>Aplicación</label>
        </div>
        <div class="input-field col s12 m6">
            <input id="nombre" name="nombre" type="text" class="validate">
            <label for="nombre">Porcentaje</label>
        </div>
        <div class="input-field col s12 m6">
            <input id="nombre" name="nombre" type="text" class="validate">
            <label for="nombre">Tope (Reintegro)</label>
        </div>
        <div class="input-field col s12">
            <textarea class="materialize-textarea" name="" id=""></textarea>
            <label for="nombre">Descripción</label>
        </div>
        <div class="col s12 right-align">
            <button type="submit" class="waves-effect waves-light btn purple darken-4">Agregar</button>
        </div>
    </div>
</form>