        
        </main>
        <footer class="footer">
            
            <div class="creado mb-2 pb-3 text-center">
                Creado por <a class="link-light" href="">DV_DEV</a>
            </div>
            
        </footer>
        <!-- SECCION MODALES -->
        @if ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/' || $_SERVER['REQUEST_URI'] == env('URL_HOST').'/cauciones' )
        <div id="modal_add_caucion" class="modal">
            <div class="modal-content">
                <h4>Añadir Caución</h4>
                @include('/agregar/agregar-caucion')
            </div>
        </div>
        @endif
        @if ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/' || $_SERVER['REQUEST_URI'] == env('URL_HOST').'/plazos-fijos' )
        <div id="modal_add_pf" class="modal">
            <div class="modal-content">
                <h4>Añadir Plazo Fijo</h4>
                @include('/agregar/agregar-plazo-fijo')
            </div>
        </div>
        @endif
        @if ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/' || $_SERVER['REQUEST_URI'] == env('URL_HOST').'/inversiones' )
        <div id="modal_add_inversion" class="modal">
            <div class="modal-content">
                <h4>Añadir Inversión</h4>
                @include('/agregar/agregar-inversion')
            </div>
        </div>
        @endif
        @if ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/' || $_SERVER['REQUEST_URI'] == env('URL_HOST').'/servicios' )
        <div id="modal_add_factura" class="modal">
            <div class="modal-content">
                <h4>Nueva Factura</h4>
                @include('/agregar/agregar-factura')
            </div>
        </div>
        <div id="modal_add_servicio" class="modal">
            <div class="modal-content">
                <h4>Añadir Servicio</h4>
                @include('/agregar/agregar-servicio')
            </div>
        </div>
        @endif
        @if ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/' || $_SERVER['REQUEST_URI'] == env('URL_HOST').'/tarjetas' )
        <div id="modal_add_resumen_tarjeta" class="modal">
            <div class="modal-content">
                <h4>Añadir Resumen Tarjeta</h4>
                @include('/agregar/agregar-resumen-tarjeta')
            </div>
        </div>
        @endif
        @if ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/' || $_SERVER['REQUEST_URI'] == env('URL_HOST').'/presupuesto' )
        <div id="modal_add_presu" class="modal">
            <div class="modal-content">
                <h4>Añadir Presupuesto</h4>
                @include('/agregar/agregar-presu')
            </div>
        </div>
        <div id="modal_add_tipo_presu" class="modal">
            <div class="modal-content">
                <h4>Añadir Tipo Presupuesto</h4>
                @include('/agregar/agregar-tipo-presu')
            </div>
        </div>
        <div id="modal_add_gasto" class="modal">
            <div class="modal-content">
                <h4>Añadir Gasto</h4>
                @include('/agregar/agregar-gasto')
            </div>
        </div>
        @endif
        <input type="hidden" id="url_host" value="{{env('URL_HOST')}}">
    </body>
    <!-- MATERIALIZE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
        });
    </script>
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- DATATABLE -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <!-- CHARTJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/helpers.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.js"></script>
    <!-- JS POR SECCIONES -->
    @if ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/' )
        <script src="{{env('URL_HOST')}}/js/servicios.js?v={{rand()}}"></script>
        <script src="{{env('URL_HOST')}}/js/tarjetas.js?v={{rand()}}"></script>
        <script src="{{env('URL_HOST')}}/js/cauciones.js?v={{rand()}}"></script>
        <script src="{{env('URL_HOST')}}/js/plazos_fijos.js?v={{rand()}}"></script>
        <script src="{{env('URL_HOST')}}/js/presupuesto.js?v={{rand()}}"></script>
        <script src="{{env('URL_HOST')}}/js/inversiones.js?v={{rand()}}"></script>
        <script>
            agregarFactura();
            agregarResumenTarjeta();
            agregarCaucion();
            agregarPlazoFijo();
            agregarInversion();
            gastoPresupuesto();
        </script>
    @elseif ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/servicios' )
        <script src="{{env('URL_HOST')}}/js/servicios.js?v={{rand()}}"></script>
        <script>
            agregarFactura();
            addServicio();
            pagarFactura();
            borrarFactura();
        </script>
    @elseif ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/tarjetas' )
        <script src="{{env('URL_HOST')}}/js/tarjetas.js?v={{rand()}}"></script>
        <script>
            agregarResumenTarjeta();
            pagarResumen();
            borrarResumen();
            detalleResumen();
        </script>
    @elseif ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/cauciones' )
        <script src="{{env('URL_HOST')}}/js/cauciones.js?v={{rand()}}"></script>
        <script>
            agregarCaucion();
            borrarCaucion();
            detalleCaucion();
        </script>
    @elseif ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/plazos-fijos' )
        <script src="{{env('URL_HOST')}}/js/plazos_fijos.js?v={{rand()}}"></script>
        <script>
            agregarPlazoFijo();
            borrarPlazoFijo();
            detallePlazoFijo();
        </script>
    @elseif ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/login' )
        <input type="hidden" id="base_host" value="{{$_SERVER['HTTP_REFERER']}}">
        <script src="{{env('URL_HOST')}}/js/login.js?v={{rand()}}"></script>
        <script>
            validaciones('{{$_SERVER['REQUEST_URI']}}');
        </script>
    @elseif ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/inversiones' )
        <script src="{{env('URL_HOST')}}/js/inversiones.js?v={{rand()}}"></script>
        <script>
            inversiones();
            agregarInversion();
            borrarInversion();
        </script>
    @elseif ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/presupuesto' )
        <script src="{{env('URL_HOST')}}/js/presupuesto.js?v={{rand()}}"></script>
        <script>
            agregarTipoPresupuesto();
            presupuesto();
            gastoPresupuesto();
        </script>
    @elseif ( $_SERVER['REQUEST_URI'] == env('URL_HOST').'/promociones' )
        <script src="{{env('URL_HOST')}}/js/promociones.js?v={{rand()}}"></script>
        <script>
            agregarPromocion();
        </script>
    @endif
</html>