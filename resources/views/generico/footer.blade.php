        
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
        <div id="modal_add_tarjeta" class="modal">
            <div class="modal-content">
                <h4>Añadir Tarjeta</h4>
                @include('/agregar/agregar-tarjeta')
            </div>
        </div>
    </body>
    <!-- MATERIALIZE JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // var elems = document.querySelectorAll('.modal');
            // var instances = M.Modal.init(elems);
            // var elems2 = document.querySelectorAll('select');
            // var instances2 = M.FormSelect.init(elems2);
            // var elems3 = document.querySelectorAll('.tooltipped');
            // var instances3 = M.Tooltip.init(elems3);
            M.AutoInit();
        });
    </script>
</html>