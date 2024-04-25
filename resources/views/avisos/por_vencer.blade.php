<div class="row">
    <div class="col12">
        <div class="card red">
            <div class="card-content white-text">
                <p class="card-title center-align">VENCEN MAÑANA, ¡OJOTA!</p>
                @foreach ($data_facturas->vencidas as $factura)
                    <div class="col6">
                        <h6>@foreach ($lista_servicios as $serv) @if ($serv->id_servicio == $factura->id_servicio) {{$serv->nombre_servicio}} @endif @endforeach</h6>
                    </div>
                    <div class="col6">
                        <a href="/servicios" class="btn">FECHA: {{$factura->vencimiento}} - ${{$factura->monto}}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>