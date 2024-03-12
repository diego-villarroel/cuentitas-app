@include('/generico/header')
    <section class="cuerpo container">
        <div class="row">
            <div class="col s12 m7">
                <h4>Servicios</h4>
            </div>
            <div class="col s12 m5 right-align">
                <button class="btn waves-effect waves-light modal-trigger" data-target="modal_add_factura">Nueva Factura</button>
            </div>
            <div class="col s12 m5 right-align" style="margin-top:20px">
                <button class="btn waves-effect waves-light modal-trigger" data-target="modal_add_servicio">Nuevo Servicio</button>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m5">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Resumen</span>
                        <p>Sin pagar</p>
                        <h5>{{$data_facturas->impagas}}</h5>
                        <p>Valor:</p>
                        <h5>${{$data_facturas->monto_total}}</h5>
                    </div>
                </div>
            </div>
            <div class="col m2"></div>
            <div class="col s12 m5">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Vencimientos</span>
                        @foreach ($lista_servicios as $serv)
                            @if (!empty($data_facturas->data_por_servicio[$serv->id_servicio] && $data_facturas->data_por_servicio[$serv->id_servicio][0]->pagado == 0))

                                <p style="margin-top:15px;margin-bottom:15px;"><b>{{$serv->nombre_servicio}}:</b></p>
                                @foreach($data_facturas->data_por_servicio[$serv->id_servicio] as $factura)
                                    @if ($factura->pagado == 0)
                                        <li style="margin-left:15px;">${{$factura->monto}} - {{$factura->vencimiento}}</li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <ul class="collapsible popout">
            @foreach ($lista_servicios as $serv)
                @if (!empty($data_facturas->data_por_servicio[$serv->id_servicio]))

                <li>
                    <div class="collapsible-header" tabindex="0">
                        <i class="material-icons">filter_drama</i>{{$serv->nombre_servicio}}
                    </div>
                    <div class="collapsible-body" style="">
                        <table>
                            <thead>
                                <tr>
                                    <th>Monto</th>
                                    <th>Pagado</th>
                                    <th>Vencimiento</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_facturas->data_por_servicio[$serv->id_servicio] as $factura)
                                <tr>
                                    <td>${{$factura->monto}}</td>
                                    <td>
                                        @if ($factura->pagado == 1) 
                                            <i class="material-icons dp48 tooltipped" data-tooltip="Pagado">check</i>
                                        @else 
                                            <i class="material-icons dp48 tooltipped" data-tooltip="Impago">money_off</i>
                                        @endif
                                    </td>
                                    <td>{{$factura->vencimiento}}</td>
                                    <td>
                                        <button class="btn wave-effect waves-light tooltipped" data-tooltip="Editar"><i class="material-icons dp48">edit</i></button>
                                        <button class="btn waves-effect waves-light modal-trigger tooltipped borrar-resumen" data-tooltip="Borrar"><i class="material-icons dp48">delete_forever</i></button>
                                        @if ($factura->pagado == '0')
                                        <button class="btn waves-effect waves-light modal-trigger tooltipped pagar-factura" data-id-factura="{{$factura->id_factura}}" data-servicio="@foreach ($lista_servicios as $serv) @if($serv->id_servicio == $factura->id_servicio) {{$serv->nombre_servicio}} @endif @endforeach" data-monto="{{$factura->monto}}" data-vencimiento="{{$factura->vencimiento}}" data-target="modal_confirm_pagar_factura" data-tooltip="Pagar"><i class="material-icons dp48">monetization_on</i></button>
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
                    
    </section>
    <form id="frm-pagar-factura">
        {{ csrf_field() }}
        <input type="hidden" name="id_factura">
    </form>
    <div id="modal_confirm_pagar_factura" class="modal">
        <div class="modal-content">
            <h4>Pagar Factura</h4>
            <p>Estas a punto de pagar la factura de <span id="servicio_pagar"></span> que tiene un valor de $<span id="valor_servicio_pagar"></span> y vence el <span id="vencimiento_servicio_pagar"></span>.</p>
            <div class="row">
                <div class="col s12 center-align">
                    <button class="btn green waves-effect waves-light" id="confirm_pagar_factura_servicio">Pagar</button>
                </div>
            </div>

            <div id="exito-pagar-factura" class="col s12 hide">
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