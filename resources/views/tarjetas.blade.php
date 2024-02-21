@include('/generico/header')
    <section class="cuerpo container">
        <div class="row">
            <div class="col s12 m7">
                <h4>Tarjetas</h4>
            </div>
            <div class="col s12 m5 right-align">
                <button class="btn waves-effect waves-light modal-trigger" data-target="modal_add_servicio">Nuevo Resumen Tarjeta</button>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m4">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Ciudad <br>Visa</span>
                        <p>Estado del mes</p>
                        <h5>Pagada</h5>
                        <p>Monto:</p>
                        <h5>$50</h5>
                        <p>Ùltima actualización:</p>
                        <h5>03/02/2024</h5>
                        <p>Vencimiento:</p>
                        <h5>03/02/2024</h5>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Galicia <br>Visa</span>
                        <p>Estado del mes</p>
                        <h5>Pagada</h5>
                        <p>Monto:</p>
                        <h5>$50</h5>
                        <p>Ùltima actualización:</p>
                        <h5>03/02/2024</h5>
                        <p>Vencimiento:</p>
                        <h5>03/02/2024</h5>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Galicia <br>Mastercad</span>
                        <p>Estado del mes</p>
                        <h5>Pagada</h5>
                        <p>Monto:</p>
                        <h5>$50</h5>
                        <p>Ùltima actualización:</p>
                        <h5>03/02/2024</h5>
                        <p>Vencimiento:</p>
                        <h5>03/02/2024</h5>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <ul class="collapsible popout">
            <li>
                <div class="collapsible-header" tabindex="0">
                    <i class="material-icons">filter_drama</i>Resúmenes de Ciudad Visa
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
            <li>
                <div class="collapsible-header" tabindex="0">
                    <i class="material-icons">filter_drama</i>Resúmenes de Galicia Visa
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
            <li>
                <div class="collapsible-header" tabindex="0">
                    <i class="material-icons">filter_drama</i>Resúmenes de Galicia Mastercard
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