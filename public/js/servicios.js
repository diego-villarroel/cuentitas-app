// =========================== //
// ======== SERVICIOS ======== //
// =========================== //

function agregarFactura() {
    $('#de_casa').on('change',function(e){
        if (e.target.checked == true) {
            e.target.value = 1;
        } else {
            e.target.value = 0;
        }
    })

    $('#add-factura').on('submit',function(e){
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url:'/agregar-factura',
            method: 'post',
            data: formData,
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Factura agregada con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace('/servicios');
                    }, 3000);
                } else {
                    console.log('error');
                }
            }
        })
    });

}

function addServicio() {
    $('#add-servicio').on('submit',function(e){
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url:'/agregar-servicio',
            method: 'post',
            data: formData,
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Servicio agregado con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace('/servicios');
                    }, 3000);
                } else {
                    console.log('error');
                }
            }
        })
    });
}

function pagarFactura() {
    $('.pagar-factura').on('click',function(){
        let factura_select = $(this).data('id-factura');
        let monto = $(this).data('monto');
        let vencimiento = $(this).data('vencimiento');
        let servicio = $(this).data('servicio');
        $('#valor_servicio_pagar').text(monto);
        $('#servicio_pagar').text(servicio.toUpperCase());
        $('#vencimiento_servicio_pagar').text(vencimiento);
        $('#frm-pagar-factura [name="id_factura"]').val(factura_select);
        
    });
    
    $('#confirm_pagar_factura_servicio').on('click',function(){
        $.ajax({
            url: '/pagar-factura',
            method: 'post',
            data: $('#frm-pagar-factura').serialize(),
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Pagaste la Factura con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace('/servicios');
                    }, 2000);
                } else {
                    console.log('error');
                }
            }
        })
    });
}
