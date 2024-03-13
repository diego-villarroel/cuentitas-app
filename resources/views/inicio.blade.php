@include('/generico/header')
    <section class="cuerpo container">
        @if ( !empty($data_facturas->vencidas) || !empty($resumen_tarjetas->resumenes_vencidos) )
            @include ('/avisos/urgente')
        
        @endif
        @if ( !empty($data_facturas->por_vencer) )
        <div class="row">
            <div class="col12">
                <div class="card orange">
                    <div class="card-content white-text">
                        <span class="card-title">VENCEN MAÑANA, OJOTA</span>
                        <p>Activos</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col s12 m4">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Cauciones</span>
                        <p>Activos</p>
                        <h5>{{$resumen_cau->activos}}</h5>
                        <p>Ganancias de este mes:</p>
                        <h5>${{$resumen_cau->ganancias_mensuales}}</h5>
                    </div>
                    <div class="card-action center-align">
                        <a class="btn-floating waves-effect waves-light modal-trigger" data-target="modal_add_caucion"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Plazos Fijos</span>
                        <p>Activos</p>
                        <h5>{{$resumen_pf->activos}}</h5>
                        <p>Ganancias esperadas:</p>
                        <h5>${{$resumen_pf->ganancia_activa}}</h5>
                    </div>
                    <div class="card-action center-align">
                        <a class="btn-floating waves-effect waves-light modal-trigger" data-target="modal_add_pf"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Inversiones</span>
                        <p>Valor total:</p>
                        <h5>$ -</h5>
                        <p> </p>
                        <h5> </h5>
                    </div>
                    <div class="card-action center-align">
                        <a class="btn-floating waves-effect waves-light" data-target="modal_add_inversion" disabled><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m4">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Servicios</span>
                        <p>Sin pagar este mes</p>
                        <h5>{{$data_facturas->impagas}}</h5>
                        <p>Monto total:</p>
                        <h5>${{$data_facturas->monto_total}}</h5>
                    </div>
                    <div class="card-action center-align">
                        <a class="btn-floating waves-effect waves-light modal-trigger" data-target="modal_add_factura"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Tarjetas</span>
                        <p>Sin pagar</p>
                        <h5>{{$resumen_tarjetas->impagas}}</h5>
                        <p>Monto actual:</p>
                        <h5>${{$resumen_tarjetas->saldo}}</h5>
                    </div>
                    <div class="card-action center-align">
                        <a class="btn-floating waves-effect waves-light modal-trigger" data-target="modal_add_resumen_tarjeta"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </div>
        </div>
                    
    </section>
@include('/generico/footer')