@include('/generico/header')
    <section class="cuerpo container">
        <div class="row">
            <div class="col s12 m7">
                <h4>Plazos Fijos</h4>
            </div>
            <div class="col s12 m5 right-align">
                <button class="btn waves-effect waves-light modal-trigger" data-target="modal_add_pf">Nuevo Plazo Fijo</button>
            </div>
        </div>
        <div class="row center-align">
            <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Plazos Fijos Tradicionales</span>
                        <p>Activos</p>
                        <h5>{{$resumen_pf->activos_tradi}}</h5>
                        <p>Ganancias:</p>
                        <h5>${{$resumen_pf->ganancia_tradi}}</h5>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Plazos Fijos UVA</span>
                        <p>Activos</p>
                        <h5>{{$resumen_pf->activos_uva}}</h5>
                        <p>Ganancias:</p>
                        <h5>${{$resumen_pf->ganancia_uva}}</h5>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @if (!empty($resumen_pf->data_pf))
        <ul class="collapsible popout">

            @foreach($resumen_pf->data_pf as $pf)
                @if ($pf->tipo_plazo_fijo == '2')
                <li>
                    <div class="collapsible-header" tabindex="0">
                        <i class="material-icons">filter_drama</i>Tradicionales
                    </div>
                    <div class="collapsible-body" style="">
                        <table>
                            <thead>
                                <tr>
                                    <th>Creado</th>
                                    <th>Ingresado</th>
                                    <th>Estado</th>
                                    <th>Días</th>
                                    <th>Ganancia</th>
                                    <th>Anual %</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resumen_pf->data_pf as $pf)
                                    @if ($pf->tipo_plazo_fijo == '2')
                                        <tr>
                                            <td>{{$pf->fecha_ingresado}}</td>
                                            <td>${{$pf->valor_ingresado}}</td>
                                            <td class="center-align">
                                                @if ($pf->activo == 0) 
                                                <i class="material-icons dp48">block</i> 
                                                @else 
                                                <i class="material-icons dp48">check</i>
                                                @endif
                                            </td>
                                            <td>{{$pf->cantidad_dias}}</td>
                                            <td>$@if( isset(explode('.',$pf->ganancia_neta)[1]) && strlen(explode('.',$pf->ganancia_neta)[1]) > 2 ) {{explode('.',$pf->ganancia_neta)[0]}}.{{substr(explode('.',$pf->ganancia_neta)[1],0,2)}} @else {{$pf->ganancia_neta}} @endif</td>
                                            <td>@if( isset(explode('.',$pf->porcentaje_ganancia_anual)[1]) && strlen(explode('.',$pf->porcentaje_ganancia_anual)[1]) > 2 ) {{explode('.',$pf->porcentaje_ganancia_anual)[0]}}.{{substr(explode('.',$pf->porcentaje_ganancia_anual)[1],0,2)}} @else {{$pf->porcentaje_ganancia_anual}} @endif%</td>
                                            <td>
                                                <button class="btn waves-effect waves-light modal-trigger detalle_pf" data-id-pf="{{$pf->id_plazo_fijo}}" data-target="modal_detalle_pf"><i class="material-icons dp48">remove_red_eye</i></button>
                                                <button class="btn waves-effect waves-light borrar-pf modal-trigger" data-target="modal_confirm_borrar_pf" data-id-pf="{{$pf->id_plazo_fijo}}" data-tipo-pf="@foreach ($tipos_pf as $tpf)
                                                    @if ($tpf->id_tipo_pf == $pf->tipo_plazo_fijo)
                                                        {{$tpf->nombre_tipo_pf}}
                                                    @endif
                                                @endforeach" data-creacion-pf="{{$pf->fecha_ingresado}}" data-ganancia-pf="{{$pf->ganancia_neta}}" data-porcentaje-pf="{{$pf->porcentaje_ganancia_anual}}"><i class="material-icons dp48">delete_forever</i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </li>
                @break
                @endif
            @endforeach

            @foreach($resumen_pf->data_pf as $pf)
                @if ($pf->tipo_plazo_fijo == '1')
                <li>
                    <div class="collapsible-header" tabindex="0">
                        <i class="material-icons">filter_drama</i>UVA
                    </div>
                    <div class="collapsible-body" style="">
                        <table>                            
                            <thead>
                                <tr>
                                    <th>Creado</th>
                                    <th>Ingresado</th>
                                    <th>Estado</th>
                                    <th>Días</th>
                                    <th>Ganancia</th>
                                    <th>Anual %</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                @foreach($resumen_pf->data_pf as $pf)
                                    @if ($pf->tipo_plazo_fijo == '1')
                                        <tr>
                                            <td>{{$pf->fecha_ingresado}}</td>
                                            <td>${{$pf->valor_ingresado}}</td>
                                            <td class="center-align">
                                                @if ($pf->activo == 0) 
                                                <i class="material-icons dp48">block</i> 
                                                @else 
                                                <i class="material-icons dp48">check</i>
                                                @endif
                                            </td>
                                            <td>{{$pf->cantidad_dias}}</td>
                                            <td>$@if( isset(explode('.',$pf->ganancia_neta)[1]) && strlen(explode('.',$pf->ganancia_neta)[1]) > 2 ) {{explode('.',$pf->ganancia_neta)[0]}}.{{substr(explode('.',$pf->ganancia_neta)[1],0,2)}} @else {{$pf->ganancia_neta}} @endif</td>
                                            <td>@if( isset(explode('.',$pf->porcentaje_ganancia_anual)[1]) && strlen(explode('.',$pf->porcentaje_ganancia_anual)[1]) > 2 ) {{explode('.',$pf->porcentaje_ganancia_anual)[0]}}.{{substr(explode('.',$pf->porcentaje_ganancia_anual)[1],0,2)}} @else {{$pf->porcentaje_ganancia_anual}} @endif%</td>
                                            <td>
                                                <button class="btn waves-effect waves-light modal-trigger detalle_pf" data-id-pf="{{$pf->id_plazo_fijo}}" data-target="modal_detalle_pf"><i class="material-icons dp48">remove_red_eye</i></button>
                                                <button class="btn waves-effect waves-light borrar-pf modal-trigger" data-target="modal_confirm_borrar_pf" data-id-pf="{{$pf->id_plazo_fijo}}" data-tipo-pf="@foreach ($tipos_pf as $tpf)
                                                    @if ($tpf->id_tipo_pf == $pf->tipo_plazo_fijo)
                                                        {{$tpf->nombre_tipo_pf}}
                                                    @endif
                                                @endforeach" data-creacion-pf="{{$pf->fecha_ingresado}}" data-ganancia-pf="{{$pf->ganancia_neta}}" data-porcentaje-pf="{{$pf->porcentaje_ganancia_anual}}"><i class="material-icons dp48">delete_forever</i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </li>
                @break
                @endif
            @endforeach
        </ul>
        @endif                  
    </section>
    <form id="frm-borrar-pf">
        {{ csrf_field() }}
        <input type="hidden" name="id_plazo_fijo">
    </form>
    <div id="modal_confirm_borrar_pf" class="modal">
        <div class="modal-content">
            <h4>Borrar Caución</h4>
            <p>Estas a punto de borrar el Plazo Fijo del tipo <span id="tipo-pf"></span>, del día <span id="fecha-pf"></span>, que tiene una ganancia de $<span id="ganancia-pf"></span> y un porcentaje anual de ganancias de <span id="porcentaje-pf"></span>%</p>
            <div class="row">
                <div class="col s12 center-align">
                    <button class="btn red waves-effect waves-light" id="confirm_borrar_pf">Borrar</button>
                </div>
            </div>
            <div id="exito-borrar-pf" class="col s12 hide">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center-align">Borraste el Plazo Fijo seleccionado... Recargando</span>
                        <div class="progress" style="margin-top:20px;margin-bottom:20px">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="frm-detalle-pf">
        {{ csrf_field() }}
        <input type="hidden" name="id_plazo_fijo">
    </form>
    <div id="modal_detalle_pf" class="modal">
        <div class="modal-content">
            <h4>Detalle Plazo Fijo</h4>
            @include('/detalles/detalle-plazo-fijo')
        </div>
    </div>
@include('/generico/footer')