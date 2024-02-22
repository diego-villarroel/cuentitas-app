        
        </main>
        <footer class="footer">
            
            <div class="creado mb-2 pb-3 text-center">
                Creado por <a class="link-light" href="">DV_DEV</a>
            </div>
            
        </footer>
        @if ( $_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/cauciones' )
        <div id="modal_add_caucion" class="modal">
            <div class="modal-content">
                <h4>Añadir Caución</h4>
                @include('/agregar/agregar-caucion')
            </div>
        </div>
        @endif
        @if ( $_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/plazos-fijos' )
        <div id="modal_add_pf" class="modal">
            <div class="modal-content">
                <h4>Añadir Plazo Fijo</h4>
                @include('/agregar/agregar-plazo-fijo')
            </div>
        </div>
        @endif
        @if ( $_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/inversiones' )
        <div id="modal_add_inversion" class="modal">
            <div class="modal-content">
                <h4>Añadir Inversión</h4>
                @include('/agregar/agregar-inversion')
            </div>
        </div>
        @endif
        @if ( $_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/servicios' )
        <div id="modal_add_servicio" class="modal">
            <div class="modal-content">
                <h4>Añadir Servicio</h4>
                @include('/agregar/agregar-servicio')
            </div>
        </div>
        @endif
        @if ( $_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/tarjetas' )
        <div id="modal_add_resumen_tarjeta" class="modal">
            <div class="modal-content">
                <h4>Añadir Resumen Tarjeta</h4>
                @include('/agregar/agregar-resumen-tarjeta')
            </div>
        </div>
        @endif
    </body>
    <!-- MATERIALIZE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
        });
        $('#activo-plazo-fijo').on('change',function(e){
            if (e.target.checked == true) {
                e.target.value = 1;
            } else {
                e.target.value = 0;
            }
        })
        $('#add-plazo-fijo').on('submit',function(e){
            e.preventDefault();
            let inputactivo = $('#activo-plazo-fijo').val();
            let formData = $(this).serialize()+'&activo='+inputactivo;
            $.ajax({
                url:'/agregar-plazo-fijo',
                method: 'post',
                data: formData,
                success: function(resp){
                    if (resp == '1') {
                        $('#exito-add-pf').removeClass('hide');
                        setInterval(() => {
                            window.location.replace('/cauciones');
                        }, 3000);
                    } else {
                        console.log('error');
                    }
                }
            })
        })
        $('.borrar-pf').on('click',function(){
            let pf_select = $(this).data('id-pf');
            let pf_tipo = $(this).data('tipo-pf');
            let pf_fecha = $(this).data('creacion-pf');
            let pf_ganancia = $(this).data('ganancia-pf');
            let pf_porcentaje = $(this).data('porcentaje-pf');
            $('#tipo-pf').text(pf_tipo.trim());
            $('#fecha-pf').text(pf_fecha);
            $('#ganancia-pf').text(pf_ganancia);
            $('#porcentaje-pf').text(pf_porcentaje);
            $('#frm-borrar-pf [name="id_plazo_fijo"]').val(pf_select);
            
        })
        $('#confirm_borrar_pf').on('click',function(){
            $.ajax({
                url: '/borrar-plazo-fijo',
                method: 'post',
                data: $('#frm-borrar-pf').serialize(),
                success: function(){
                    if (resp == '1') {
                        $('#exito-borrar-pf').removeClass('hide');
                        setInterval(() => {
                            window.location.replace('/plazos-fijos');
                        }, 2000);
                    } else {
                        console.log('error');
                    }
                }
            })
        })
        // =========================== //
        // ======== CAUCIONES ======== //
        // =========================== //
        $('#activo-caucion').on('change',function(e){
            if (e.target.checked == true) {
                e.target.value = 1;
            } else {
                e.target.value = 0;
            }
        })
        $('#add-caucion').on('submit',function(e){
            e.preventDefault();
            let inputactivo = $('#activo-caucion').val();
            let formData = $(this).serialize()+'&activo='+inputactivo;
            $.ajax({
                url:'/agregar-caucion',
                method: 'post',
                data: formData,
                success: function(resp){
                    if (resp == '1') {
                        $('#exito-add-caucion').removeClass('hide');
                        setInterval(() => {
                            window.location.replace('/cauciones');
                        }, 3000);
                    } else {
                        console.log('error');
                    }
                }
            })
        })
        
        $('.borrar-caucion').on('click',function(){
            let caucion_select = $(this).data('id-caucion');
            let caucion_fecha = $(this).data('fecha-caucion');
            let caucion_ganancia = $(this).data('ganancia-caucion');
            let caucion_porcentaje = $(this).data('porcentaje-caucion');
            $('#fecha-caucion-borrar').text(caucion_fecha);
            $('#ganancia-caucion-borrar').text(caucion_ganancia);
            $('#porcentaje-caucion-borrar').text(caucion_porcentaje);
            $('#frm-borrar-caucion [name="id_caucion"]').val(caucion_select);
            
        })
        $('#confirm_borrar_caucion').on('click',function(){
            $.ajax({
                url: '/borrar-caucion',
                method: 'post',
                data: $('#frm-borrar-caucion').serialize(),
                success: function(){
                    if (resp == '1') {
                        $('#exito-borrar-caucion').removeClass('hide');
                        setInterval(() => {
                            window.location.replace('/cauciones');
                        }, 2000);
                    } else {
                        console.log('error');
                    }
                }
            })
        })
    </script>
</html>