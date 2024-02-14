@include('/generico/header')
    <section class="cuerpo container">

        <div class="row">
            <div class="col s12 m10">
                <h4>Plazos Fijos</h4>
            </div>
            <div class="col s12 m2">
                <button class="btn waves-effect waves-light modal-trigger" data-target="modal_add_pf">Nueva_Plazo_Fijo</button>
            </div>
        </div>
        <div class="row center-align">
            <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Plazos Fijos Tradicionales</span>
                        <p>Activos</p>
                        <h5>2</h5>
                        <p>Ganancias:</p>
                        <h5>$50</h5>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Plazos Fijos UVA</span>
                        <p>Activos</p>
                        <h5>1</h5>
                        <p>Ganancias:</p>
                        <h5>$50</h5>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <ul class="collapsible popout">
            <li>
                <div class="collapsible-header" tabindex="0">
                    <i class="material-icons">filter_drama</i>Tradicionales
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
                    <i class="material-icons">filter_drama</i>UVA
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