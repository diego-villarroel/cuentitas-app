@include('/generico/header')
    <section class="cuerpo container">
        <div class="row">
            <div class="col s12 m7">
                <h4>Servicios</h4>
            </div>
            <div class="col s12 m5 right-align">
                <button class="btn red darken-4 waves-effect waves-light modal-trigger" data-target="modal_add_factura">Nueva Factura</button>
            </div>
            <div class="col s12 m5 right-align" style="margin-top:20px">
                <button class="btn light-green darken-4 waves-effect waves-light modal-trigger" data-target="modal_add_servicio">Nuevo Servicio</button>
            </div>
        </div>
        @if (!empty($data_facturas->data_por_servicio))
            <div class="row">
                <div class="col s12 m5">
                    <div class="card purple darken-4">
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
                    @if ( !empty($data_facturas->vencidas) )
                        @include ('/avisos/urgente')                
                    @endif
                    @if ( !empty($data_facturas->por_vencer) )
                        @include('/avisos/por_vencer')
                    @endif
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
                                        <th>Monto Mora</th>
                                        <th>Segundo Ven.</th>
                                        <th>De Donde</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_facturas->data_por_servicio[$serv->id_servicio] as $factura)
                                    <tr>
                                        <td>${{$factura->monto_servicio_string}}</td>
                                        <td>
                                            @if ($factura->pagado == 1) 
                                                <i class="material-icons dp48 tooltipped" data-tooltip="Pagado">check</i>
                                            @else 
                                                <i class="material-icons dp48 tooltipped" data-tooltip="Impago">money_off</i>
                                            @endif
                                        </td>
                                        <td>{{$factura->vencimiento}}</td>
                                        <td>$ @if (!empty($factura->monto_mora_string)) {{$factura->monto_mora_string}} @else --- @endif</td>
                                        <td>{{$factura->segundo_vencimiento}}</td>
                                        <td>@if ($factura->de_casa) <i class="material-icons dp48">home</i> @else <i class="material-icons dp48">favorite</i> @endif </td>
                                        <td>
                                            <button class="btn red darken-4 waves-effect waves-light modal-trigger tooltipped borrar-resumen" data-tooltip="Borrar" data-id-factura="{{$factura->id_factura}}" data-servicio="@foreach ($lista_servicios as $serv) @if($serv->id_servicio == $factura->id_servicio) {{$serv->nombre_servicio}} @endif @endforeach" data-monto="{{$factura->monto}}" data-vencimiento="{{$factura->vencimiento}}" data-target="modal_confirm_borrar_factura"><i class="material-icons dp48">delete_forever</i></button>
                                            @if ($factura->pagado == '0')
                                            <button class="btn light-green darken-4 waves-effect waves-light modal-trigger tooltipped pagar-factura" data-id-factura="{{$factura->id_factura}}" data-servicio="@foreach ($lista_servicios as $serv) @if($serv->id_servicio == $factura->id_servicio) {{$serv->nombre_servicio}} @endif @endforeach" data-monto="{{$factura->monto}}" data-vencimiento="{{$factura->vencimiento}}" data-target="modal_confirm_pagar_factura" data-tooltip="Pagar"><i class="material-icons dp48">monetization_on</i></button>
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
        @else
            <div class="row">
                <h5 class="center-align">Sin Servicios</h5>
            </div>
        @endif
                    
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

            
        </div>
    </div>
    <div id="modal_confirm_borrar_factura" class="modal">
        <div class="modal-content">
            <h4>Pagar Factura</h4>
            <p>Estas a punto de borrar la factura de <span id="servicio_borrar"></span> que tiene un valor de $<span id="valor_servicio_borrar"></span> y vence el <span id="vencimiento_servicio_borrar"></span>.</p>
            <div class="row">
                <div class="col s12 center-align">
                    <button class="btn red waves-effect waves-light" id="confirm_borrar_factura_servicio">Borrar</button>
                </div>
            </div>
        </div>
    </div>
@include('/generico/footer')