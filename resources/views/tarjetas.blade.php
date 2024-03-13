@include('/generico/header')
    <section class="cuerpo container">
        <div class="row">
            <div class="col s12 m7">
                <h4>Tarjetas</h4>
            </div>
            <div class="col s12 m5 right-align">
                <button class="btn waves-effect waves-light modal-trigger" data-target="modal_add_resumen_tarjeta">Nuevo Resumen Tarjeta</button>
            </div>
        </div>
        <div class="row">
            @foreach ($lista_tarjetas as $tarjeta)
                @php $sin_resumen = 1; @endphp
                <div class="col s12 m4">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">@if(count(explode(' ',$tarjeta->nombre_tarjeta)) == 2){{ explode(' ',$tarjeta->nombre_tarjeta)[0] }} <br> {{explode(' ',$tarjeta->nombre_tarjeta)[1]}}@endif</span>
                            @foreach($data_tarjetas->data_completa as $resumen)
                                @if($resumen->id_tarjeta == $tarjeta->id_tarjeta && $resumen->activo == 1)
                                    @php $sin_resumen = 0; @endphp
                                    <p>Estado del mes</p>
                                    <h5>
                                        @if ($resumen->pagado == 1) 
                                            <i class="material-icons dp48">check</i>
                                        @else 
                                            <i class="material-icons dp48">money_off</i>
                                        @endif
                                    </h5>
                                    <p>Monto:</p>
                                    <h5>${{$resumen->monto}}</h5>
                                    <p>Corte:</p>
                                    <h5>{{$resumen->corte}}</h5>
                                    <p>Vencimiento:</p>
                                    <h5>{{$resumen->vencimiento}}</h5>
                                @endif
                            @endforeach
                            @if ($sin_resumen == 1)
                                <p>Estado del mes</p>
                                <h5> - </h5>
                                <p>Monto:</p>
                                <h5> - </h5>
                                <p>Corte:</p>
                                <h5> - </h5>
                                <p>Vencimiento:</p>
                                <h5> - </h5>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if (!empty($data_tarjetas->data_completa))
        <hr>
        <ul class="collapsible popout">
            @foreach ($lista_tarjetas as $tarjeta)
                @if ( isset($lista_resumen_tarjetas->resumenes_tarjetas[$tarjeta->id_tarjeta]) && !empty($lista_resumen_tarjetas->resumenes_tarjetas[$tarjeta->id_tarjeta]) )
                    <li>
                        <div class="collapsible-header" tabindex="0">
                            <i class="material-icons">filter_drama</i>Resúmenes de {{$lista_resumen_tarjetas->nombres_tarjetas[$tarjeta->id_tarjeta]}}
                        </div>
                        <div class="collapsible-body" style="">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Periodo</th>
                                        <th>Monto</th>
                                        <th>Estado</th>
                                        <th>Vencimiento</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lista_resumen_tarjetas->resumenes_tarjetas[$tarjeta->id_tarjeta] as $resumen)
                                    <tr>
                                        <td>{{$resumen->periodo}}</td>
                                        <td>${{$resumen->monto}}</td>
                                        <td>
                                            @if ($resumen->pagado == 1) 
                                                <i class="material-icons dp48 tooltipped" data-tooltip="Pagado">check</i>
                                            @else 
                                                <i class="material-icons dp48 tooltipped" data-tooltip="Impago">money_off</i>
                                            @endif
                                        </td>
                                        <td>${{$resumen->vencimiento}}</td>
                                        <td>
                                            <button class="btn wave-effect waves-light tooltipped" data-tooltip="Editar"><i class="material-icons dp48">edit</i></button>
                                            <button class="btn waves-effect waves-light modal-trigger tooltipped borrar-resumen" data-target="modal_confirm_borrar_resumen" data-id-resumen="{{$resumen->id_resumen_tarjeta}}" data-periodo="{{$resumen->periodo}}" data-monto="{{$resumen->monto}}" data-vencimiento="{{$resumen->vencimiento}}" data-tarjeta="@foreach ($lista_tarjetas as $tarjeta) @if($tarjeta->id_tarjeta == $resumen->id_tarjeta) {{$tarjeta->nombre_tarjeta}} @endif @endforeach" data-tooltip="Borrar"><i class="material-icons dp48">delete_forever</i></button>
                                            @if ($resumen->pagado == '0')
                                            <button class="btn waves-effect waves-light modal-trigger tooltipped pagar-resumen" data-id-resumen="{{$resumen->id_resumen_tarjeta}}" data-target="modal_confirm_pagar_resumen"  data-periodo="{{$resumen->periodo}}" data-monto="{{$resumen->monto}}" data-vencimiento="{{$resumen->vencimiento}}" data-tarjeta="@foreach ($lista_tarjetas as $tarjeta) @if($tarjeta->id_tarjeta == $resumen->id_tarjeta) {{$tarjeta->nombre_tarjeta}} @endif @endforeach" data-tooltip="Pagar"><i class="material-icons dp48">monetization_on</i></button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
        @endif
    </section>
    <form id="frm-borrar-resumen">
        {{ csrf_field() }}
        <input type="hidden" name="id_resumen">
    </form>
    <form id="frm-pagar-resumen">
        {{ csrf_field() }}
        <input type="hidden" name="id_resumen">
    </form>
    <div id="modal_confirm_borrar_resumen" class="modal">
        <div class="modal-content">
            <h4>Borrar Resumen</h4>
            <p>Estas a punto de borrar el resumen de la tarjeta <span id="tarjeta_resumen"></span> del periodo <span id="periodo_resumen"></span>, que tiene un gasto de $<span id="monto_resumen"></span> y vence el <span id="vencimiento_resumen"></span>.</p>
            <div class="row">
                <div class="col s12 center-align">
                    <button class="btn red waves-effect waves-light" id="confirm_borrar_resumen">Borrar</button>
                </div>
            </div>
            <div id="exito-borrar-resumen" class="col s12 hide">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center-align">Borraste el Resumen de Tarjeta seleccionado... Recargando</span>
                        <div class="progress" style="margin-top:20px;margin-bottom:20px">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_confirm_pagar_resumen" class="modal">
        <div class="modal-content">
            <h4>Pagar Resumen</h4>
            <p>Estas a punto de pagar el resumen de la tarjeta <span id="tarjeta_resumen_pagar"></span> del periodo <span id="periodo_resumen_pagar"></span>, que tiene un gasto de $<span id="monto_resumen_pagar"></span> y vence el <span id="vencimiento_resumen_pagar"></span>.</p>
            <div class="row">
                <div class="col s12 center-align">
                    <button class="btn green waves-effect waves-light" id="confirm_pagar_resumen">Pagar</button>
                </div>
            </div>
            <div id="exito-pagar-resumen" class="col s12 hide">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title center-align">Pagado con éxito! Recargando</span>
                        <div class="progress" style="margin-top:20px;margin-bottom:20px">
                            <div class="indeterminate"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('/generico/footer')