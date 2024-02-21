        
        </main>
        <footer class="footer">
            
            <div class="creado mb-2 pb-3 text-center">
                Creado por <a class="link-light" href="">DV_DEV</a>
            </div>
            
        </footer>
        <div id="modal_add_caucion" class="modal">
            <div class="modal-content">
                <h4>Añadir Caución</h4>
                @include('/agregar/agregar-caucion')
            </div>
        </div>
        <div id="modal_add_pf" class="modal">
            <div class="modal-content">
                <h4>Añadir Plazo Fijo</h4>
                @include('/agregar/agregar-plazo-fijo')
            </div>
        </div>
        <div id="modal_add_inversion" class="modal">
            <div class="modal-content">
                <h4>Añadir Inversión</h4>
                @include('/agregar/agregar-inversion')
            </div>
        </div>
        <div id="modal_add_servicio" class="modal">
            <div class="modal-content">
                <h4>Añadir Servicio</h4>
                @include('/agregar/agregar-servicio')
            </div>
        </div>
        <div id="modal_add_resumen_tarjeta" class="modal">
            <div class="modal-content">
                <h4>Añadir Resumen Tarjeta</h4>
                @include('/agregar/agregar-resumen-tarjeta')
            </div>
        </div>
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
                        console.log('bien');
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
            $('#frm-borrar-caucion [name="id_caucion"]').val(caucion_select);
            $.ajax({
                url: '/borrar-caucion',
                method: 'post',
                data: $('#frm-borrar-caucion').serialize(),
                success: function(){
                    if (resp == '1') {
                        $('#exito-add-caucion').removeClass('hide');
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