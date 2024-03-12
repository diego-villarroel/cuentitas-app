
// ========================== //
// ======== TARJETAS ======== //
// ========================== //

function agregarResumenTarjeta() {
    $('#add-resumen-tarjeta').on('submit',function(e){
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url:'/agregar-resumen-tarjeta',
            method: 'post',
            data: formData,
            success: function(resp){
                if (resp == '1') {
                    $('#exito-add-resumen-tarjeta').removeClass('hide');
                    setInterval(() => {
                        window.location.replace('/tarjetas');
                    }, 3000);
                } else {
                    console.log('error');
                }
            }
        })
    });
}

function borrarResumen() {
    $('.borrar-resumen').on('click',function(){
        let resumen_select = $(this).data('id-resumen');
        let periodo = $(this).data('periodo');
        let monto = $(this).data('monto');
        let vencimiento = $(this).data('vencimiento');
        let tarjeta = $(this).data('tarjeta');
        $('#periodo_resumen').text(periodo);
        $('#monto_resumen').text(monto);
        $('#tarjeta_resumen').text(tarjeta)
        $('#vencimiento_resumen').text(vencimiento);
        $('#frm-borrar-resumen [name="id_resumen"]').val(resumen_select);
        
    });
    
    $('#confirm_borrar_resumen').on('click',function(){
        $.ajax({
            url: '/borrar-resumen-tarjeta',
            method: 'post',
            data: $('#frm-borrar-resumen').serialize(),
            success: function(resp){
                if (resp == '1') {
                    $('#exito-borrar-resumen').removeClass('hide');
                    setInterval(() => {
                        window.location.replace('/tarjetas');
                    }, 2000);
                } else {
                    console.log('error');
                }
            }
        })
    });
}

function pagarResumen() {
    $('.pagar-resumen').on('click',function(){
        let resumen_select = $(this).data('id-resumen');
        let periodo = $(this).data('periodo');
        let monto = $(this).data('monto');
        let vencimiento = $(this).data('vencimiento');
        let tarjeta = $(this).data('tarjeta');
        $('#periodo_resumen_pagar').text(periodo);
        $('#monto_resumen_pagar').text(monto);
        $('#tarjeta_resumen_pagar').text(tarjeta)
        $('#vencimiento_resumen_pagar').text(vencimiento);
        $('#frm-pagar-resumen [name="id_resumen"]').val(resumen_select);
        
    });
    
    console.log('pagar');
    $('#confirm_pagar_resumen').on('click',function(){
        $.ajax({
            url: '/pagar-resumen-tarjeta',
            method: 'post',
            data: $('#frm-pagar-resumen').serialize(),
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Pagado con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace('/tarjetas');
                    }, 3000);
                } else {
                    console.log('error');
                }
            }
        })
    });
}
