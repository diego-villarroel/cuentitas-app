<div class="row">
    <div class="col12">
        <div class="card red">
            <div class="card-content white-text">
                <p class="card-title center-align">¡VENCIDOS, URGENTE!</p>
                <div class="row">
                    <div class="col s6">
                    @if ( !empty($data_facturas->vencidas) )
                    <h6>SERVICIOS</h6>
                        @foreach ($data_facturas->vencidas as $factura)
                            <div class="col6">
                                <div>@foreach ($lista_servicios as $serv) @if ($serv->id_servicio == $factura->id_servicio) {{$serv->nombre_servicio}} @endif @endforeach</div>
                            </div>
                            @if($_SERVER['REQUEST_URI'] != env('URL_HOST').'/servicios') 
                            <div class="col6">
                                <a href="{{env('URL_HOST')}}/servicios" class="btn">FECHA: {{$factura->vencimiento}} - ${{$factura->monto}}</a>
                            </div>
                            @else                             
                            <div class="col6">
                                <small>{{$factura->vencimiento}} - $ {{$factura->monto}}</small>
                            </div>
                            @endif
                        @endforeach
                    @endif
                    </div>
                    <div class="col s6 right-align">
                        @if ( !empty($resumen_tarjetas->resumenes_vencidos) )
                            <h6>TARJETAS</h6>
                            @foreach ($resumen_tarjetas->resumenes_vencidos as $resumen)
                                <div class="col6">
                                    <h6>@foreach ($lista_tarjetas as $tarjeta) @if ($tarjeta->id_tarjeta == $resumen->id_tarjeta) {{$tarjeta->nombre_tarjeta}} @endif @endforeach</h6>
                                </div>
                                @if($_SERVER['REQUEST_URI'] != env('URL_HOST').'/tarjetas') 
                                <div class="col6">
                                    <a href="{{env('URL_HOST')}}/tarjetas" class="btn">FECHA: {{$resumen->vencimiento}} - ${{$resumen->monto}}</a>
                                </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>