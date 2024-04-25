@include('/generico/header')
    <section class="cuerpo container">
        <div class="row">
            <div class="col s12 m7">
                <h4>Cauciones</h4>
            </div>
            <div class="col s12 m5 right-align">
                <button class="btn waves-effect waves-light modal-trigger" data-target="modal_add_caucion">Nueva Caución</button>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m5">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Cauciones Total</span>
                        <p>Cantidad de Cauciones:</p>
                        <h5>{{$resumen_cau->total_cantidad_cauciones}}</h5>
                        <p>Ganancias Totales:</p>
                        <h5>${{$resumen_cau->ganancia_total}}</h5>
                    </div>
                </div>
            </div>
            <div class="col m2">
            </div>
            <div class="col s12 m5">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Cauciones Mensual</span>
                        <p>Activos</p>
                        <h5>{{$resumen_cau->activos}}</h5>
                        <p>Ganancias</p>
                        <h5>${{$resumen_cau->ganancias_mensuales}}</h5>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <ul class="collapsible popout">
            @foreach ($resumen_cau->data_cauciones_por_periodo as $k => $periodo)
            <li>
                <div class="collapsible-header" tabindex="0">
                    <i class="material-icons dp48">date_range</i>{{$k}}
                </div>
                <div class="collapsible-body">
                    <div class="row center-align data-mes">
                        <div class="col s12 m4">
                            Cauciones del mes: {{$periodo['cantidad']}}
                        </div>
                        <div class="col s12 m4">
                            Ganancias promedios: {{$periodo['ganancia_promedio']}}
                        </div>
                        <div class="col s12 m4">
                            Ganancias total: {{$periodo['total']}}
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Ganancia</th>
                                <th class="center-align">Estado</th>
                                <th class="center-align">Porcentaje (mes)</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periodo as $cau)
                                @if (is_object($cau))
                                <tr>
                                    <td>{{$cau->creado}}</td>
                                    <td>$ {{$cau->ganancia_neta_string}}</td>
                                    <td class="center-align">
                                        @if ($cau->activo == 0) 
                                        <i class="material-icons dp48">block</i> 
                                        @else 
                                        <i class="material-icons dp48">check</i>
                                        @endif
                                    
                                    </td>
                                    <td class="center-align">{{$cau->porcentaje_anual_ganancia_string}} %</td>
                                    <td>
                                        <button class="btn waves-effect waves-light modal-trigger detalle-caucion" data-target="modal_detalle_caucion" data-id-caucion="{{$cau->id_caucion}}"><i class="material-icons dp48">remove_red_eye</i></button>
                                        <button class="btn waves-effect waves-light borrar-caucion modal-trigger" data-target="modal_confirm_borrar_caucion" data-id-caucion="{{$cau->id_caucion}}" data-fecha-caucion="{{$cau->creado}}" data-ganancia-caucion="{{$cau->ganancia_neta_string}}" data-porcentaje-caucion="{{$cau->porcentaje_anual_ganancia_string}}"><i class="material-icons dp48">delete_forever</i></button>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </li>
            @endforeach
        </ul>
                    
    </section>
    <form id="frm-borrar-caucion">
        {{ csrf_field() }}
        <input type="hidden" name="id_caucion">
    </form>
    <div id="modal_confirm_borrar_caucion" class="modal">
        <div class="modal-content">
            <h4>Borrar Caución</h4>
            <p>Estas a punto de borrar la Caución del día <span id="fecha-caucion-borrar"></span>, que tiene una ganancia de $<span id="ganancia-caucion-borrar"></span> y un porcentaje anual de ganancias de <span id="porcentaje-caucion-borrar"></span>%</p>
            <div class="row">
                <div class="col s12 center-align">
                    <button class="btn red waves-effect waves-light" id="confirm_borrar_caucion">Borrar</button>
                </div>
            </div>
            <div id="exito-borrar-caucion" class="col s12 hide">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center-align">Borraste la Caución seleccionada... Recargando</span>
                        <div class="progress" style="margin-top:20px;margin-bottom:20px">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form id="frm-detalle-caucion">
        {{ csrf_field() }}
        <input type="hidden" name="id_caucion">
    </form>
    <div id="modal_detalle_caucion" class="modal">
        <div class="modal-content">
            <h4>Detalle Caución</h4>
            @include('/detalles/detalle-caucion')
        </div>
    </div>
@include('/generico/footer')