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
            <div class="col s12 m6">
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
            <div class="col s12 m6">
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
            <li>
                <div class="collapsible-header" tabindex="0">
                    <i class="material-icons">filter_drama</i>Resumen
                </div>
                <div class="collapsible-body" style="">
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
                            @foreach ($resumen_cau->data_completa as $cau)
                            <tr>
                                <td>{{$cau->creado}}</td>
                                <td>$ @if( isset(explode('.',$cau->ganancia_neta)[1]) && strlen(explode('.',$cau->ganancia_neta)[1]) > 2 ) {{explode('.',$cau->ganancia_neta)[0]}}.{{substr(explode('.',$cau->ganancia_neta)[1],0,2)}} @else {{$cau->ganancia_neta}} @endif</td>
                                <td class="center-align">
                                    @if ($cau->activo == 0) 
                                    <i class="material-icons dp48">block</i> 
                                    @else 
                                    <i class="material-icons dp48">check</i>
                                    @endif
                                
                                </td>
                                <td class="center-align">% @if( isset(explode('.',$cau->porcentaje_anual_ganancia)[1]) && strlen(explode('.',$cau->porcentaje_anual_ganancia)[1]) > 2 ) {{explode('.',$cau->porcentaje_anual_ganancia)[0]}}.{{substr(explode('.',$cau->porcentaje_anual_ganancia)[1],0,2)}} @else {{$cau->porcentaje_anual_ganancia}} @endif</td>
                                <td>
                                    <button class="btn waves-effect waves-light "><i class="material-icons dp48">remove_red_eye</i></button>
                                    <button class="btn waves-effect waves-light borrar-caucion" data-id-caucion="{{$cau->id_caucion}}"><i class="material-icons dp48">delete_forever</i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </li>
        </ul>
                    
    </section>
    <form id="frm-borrar-caucion">
        {{ csrf_field() }}
        <input type="hidden" name="id_caucion">
    </form>
@include('/generico/footer')