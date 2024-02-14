@include('/generico/header')
    <section class="cuerpo container">
        <div class="row">
            <div class="col s12 m10">
                <h4>Cauciones</h4>
            </div>
            <div class="col s12 m2">
                <button class="btn waves-effect waves-light modal-trigger" data-target="modal_add_caucion">Nueva_Caución</button>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Cauciones Total</span>
                        <p>Activos</p>
                        <h5>2</h5>
                        <p>Ganancias Totales:</p>
                        <h5>$50</h5>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Cauciones Mensual</span>
                        <p>Activos</p>
                        <h5>2</h5>
                        <p>Ganancias</p>
                        <h5>$50</h5>
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
                                <th>Periodo</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>01-24</td>
                                <td>$250.000</td>
                                <td>Pagado</td>
                                <td>
                                    <button>Ver Detalle</button>
                                    <button>Desactivar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </li>
        </ul>
                    
    </section>
@include('/generico/footer')