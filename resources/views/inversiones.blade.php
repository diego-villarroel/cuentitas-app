
@include('/generico/header')
    <section class="cuerpo container">
        <div class="row">
            <div class="col s12 m7">
                <h4>Cartera / Portafolio</h4>
            </div>
            <div class="col s12 m5 right-align">
                <button class="btn light-green darken-4 waves-effect waves-light modal-trigger" data-target="modal_add_inversion">Nueva Inversión</button>
            </div>
        </div>
        @if (!empty($inversiones))
            <div class="row">
                <div class="col s12">
                    <div class="card purple darken-4">
                        <div class="card-content white-text">
                            <span class="card-title">Resumen</span>
                            <p>Valor total:</p>
                            <h5>$ {{$total_inversiones}}</h5>
                            <canvas id="inversiones"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <ul class="collapsible popout">
                @foreach ($inversiones as $inv)
                    <input type="hidden" class="label_inversiones" value="{{$inv->nombre_tipo_inversion}}">
                    <input type="hidden" class="valores_inversiones" value="{{$inv->total_inversion}}">
                    <input type="hidden" class="graf_tipo_inv" value="{{$inv->id_tipo_inversion}}" data-valor-tot="{{$inv->total_inversion_string}}">
                    <li>
                        <div class="collapsible-header" tabindex="0">
                            <i class="material-icons">filter_drama</i>
                            {{$inv->nombre_tipo_inversion}}
                        </div>
                        <div class="collapsible-body" style="">
                            <canvas  id="graf-inversion-segmentada-{{$inv->id_tipo_inversion}}" height="50px" style="margin-bottom:10px"></canvas>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Periodo</th>
                                        <th>Nombre</th>
                                        <th>Monto</th>
                                        <th>Unidades</th>
                                        <th>Valor Unidad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inv->data_inversiones as $una_inv)
                                        <input type="hidden" class="una-inv-{{$inv->id_tipo_inversion}}" value="{{$una_inv->id_inversion}}" data-nombre-inv="{{$una_inv->nombre_inversion}}" data-valor-neto="{{$una_inv->valor_neto}}">
                                        <tr>
                                            <td>{{$una_inv->fecha_compra}}</td>
                                            <td>{{$una_inv->nombre_inversion}}</td>
                                            <td>$ {{$una_inv->valor_neto_string}}</td>
                                            <td>{{$una_inv->unidad}}</td>
                                            <td>$ {{$una_inv->valor_unidad_string}}</td>
                                            <td>
                                                <button class="btn purple lighten-2 waves-effect waves-light modal-trigger detalle_pf tooltiped" data-target="modal_detalle_inv" data-tooltip="Detalle"><i class="material-icons dp48">remove_red_eye</i></button>
                                                <button class="btn light-green darken-4 waves-effect waves-light modal-trigger vender_inv" data-target="modal_confirm_vender_inv" data-tooltip="Vender"><i class="material-icons dp48">local_grocery_store</i></button>
                                                <button class="btn red darken-2 waves-effect waves-light borrar-inv modal-trigger" data-target="modal_confirm_borrar_inv" data-tooltip="Borrar" data-id-inv="{{$una_inv->id_inversion}}" data-nombre-inv="{{$una_inv->nombre_inversion}}" data-fecha-inv="{{$una_inv->fecha_compra}}" data-valor-inv="{{$una_inv->valor_neto_string}}" data-cantidad-inv="{{$una_inv->unidad}}"><i class="material-icons dp48">delete_forever</i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="row">
                <h5 class="center-align">Portafolio vacío</h5>
            </div>
        @endif
                    
    </section>


    <form id="frm-borrar-inversion">
        {{ csrf_field() }}
        <input type="hidden" name="id_inversion">
    </form>

    <div id="modal_confirm_borrar_inv" class="modal">
        <div class="modal-content">
            <h4>Borrar Caución</h4>
            <p>Estas a punto de borrar la Inversion <b><span id="nombre-inv-borrar"></span></b>, del día <span id="fecha-inv-borrar"></span>, que tiene un valor de $ <span id="valor-inv-borrar"></span> y tiene <span id="cantidad-inv-borrar"></span> unidad/es</p>
            <div class="row">
                <div class="col s12 center-align">
                    <button class="btn red waves-effect waves-light" id="confirm_borrar_inv">Borrar</button>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_confirm_vender_inv" class="modal">
        <div class="modal-content">
            <h4>Vender Caución</h4>
            <p>Estas a punto de vender la Inversion <b><span id="nombre-inv-borrar"></span></b>, del día <span id="fecha-inv-borrar"></span>, que tiene un valor de $ <span id="valor-inv-borrar"></span> y tiene <span id="cantidad-inv-borrar"></span> unidad/es. </p>
            <br>
            <div class="row">
                <div class="col s12 center-align">
                    <button class="btn light-green darken-3 waves-effect waves-light" id="confirm_borrar_inv">Vender u$d</button>
                    <button class="btn light-green darken-4 waves-effect waves-light" id="confirm_borrar_inv">Vender ARG</button>
                </div>
            </div>
        </div>
    </div>
@include('/generico/footer')