@include('/generico/header')
    <section class="cuerpo container">
        @if ( !empty($data_facturas->vencidas) || !empty($resumen_tarjetas->resumenes_vencidos) )
            @include ('/avisos/urgente')
        
        @endif
        @if ( !empty($data_facturas->por_vencer) )
            @include('/avisos/por_vencer')
        @endif
        <div class="row">
            <div class="col s12 m4">
                <div class="card purple darken-4">
                    <div class="card-content white-text">
                        <span class="card-title">Cauciones</span>
                        <p>Activos</p>
                        <h5>{{$resumen_cau->activos}}</h5>
                        <p>Ganancias de este mes:</p>
                        <h5>${{$resumen_cau->ganancias_mensuales}}</h5>
                    </div>
                    <div class="card-action center-align">
                        <a class="btn-floating light-green darken-4 waves-effect waves-light modal-trigger" data-target="modal_add_caucion"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card purple darken-4">
                    <div class="card-content white-text">
                        <span class="card-title">Plazos Fijos</span>
                        <p>Activos</p>
                        <h5>{{$resumen_pf->activos}}</h5>
                        <p>Ganancias esperadas:</p>
                        <h5>${{$resumen_pf->ganancia_activa}}</h5>
                    </div>
                    <div class="card-action center-align">
                        <a class="btn-floating light-green darken-4 waves-effect waves-light modal-trigger" data-target="modal_add_pf"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card purple darken-4">
                    <div class="card-content white-text">
                        <span class="card-title">Inversiones</span>
                        <p>Cantidad Total</p>
                        <h5>{{$inversiones[2]}}</h5>
                        <p>Valor total:</p>
                        <h5>$ {{$inversiones[3]}}</h5>
                    </div>
                    <div class="card-action center-align">
                        <a class="btn-floating light-green darken-4 waves-effect waves-light modal-trigger" data-target="modal_add_inversion"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m4">
                <div class="card purple darken-4">
                    <div class="card-content white-text">
                        <span class="card-title">Servicios</span>
                        <p>Sin pagar este mes</p>
                        <h5>{{$data_facturas->impagas}}</h5>
                        <p>Monto total:</p>
                        <h5>${{$data_facturas->monto_total}}</h5>
                    </div>
                    <div class="card-action center-align">
                        <a class="btn-floating red darken-4 waves-effect waves-light modal-trigger" data-target="modal_add_factura"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card purple darken-4">
                    <div class="card-content white-text">
                        <span class="card-title">Tarjetas</span>
                        <p>Sin pagar</p>
                        <h5>{{$resumen_tarjetas->impagas}}</h5>
                        <p>Monto actual:</p>
                        <h5>${{$resumen_tarjetas->saldo}}</h5>
                    </div>
                    <div class="card-action center-align">
                        <a class="btn-floating red darken-4 waves-effect waves-light modal-trigger" data-target="modal_add_resumen_tarjeta"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card purple darken-4">
                    <div class="card-content white-text">
                        <span class="card-title">Presupuestos</span>
                        <p>Monto Total:</p>
                        <h5>{{ $data_presupuestos->total_monto }}</h5>
                        <p>Gastado total:</p>
                        <h5>$ {{ $data_presupuestos->total_gastado }}</h5>
                    </div>
                    <div class="card-action center-align">
                    <a class="btn-floating red darken-4 waves-effect tooltipped waves-light modal-trigger" data-target="modal_add_gasto" data-tooltip="Nuevo gasto" data-presupuesto=""><i class="material-icons dp48">attach_money</i></a>
                    </div>
                </div>
            </div>
        </div>
                    
    </section>
@include('/generico/footer')