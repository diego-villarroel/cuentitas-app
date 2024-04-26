
// ========================== //
// ======== TARJETAS ======== //
// ========================== //

function agregarResumenTarjeta() {
    let url_hots = $('#url_host').val();
    $('#add-resumen-tarjeta').on('submit',function(e){
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url:url_hots+'/agregar-resumen-tarjeta',
            method: 'post',
            data: formData,
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Resumen agregado con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/tarjetas');
                    }, 3000);
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar resumen. Intenta nuevamente', classes: 'rounded red'});
                }
            }
        })
    });
}

function borrarResumen() {
    let url_hots = $('#url_host').val();
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
            url: url_hots+'/borrar-resumen-tarjeta',
            method: 'post',
            data: $('#frm-borrar-resumen').serialize(),
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Borraste el Resumen de una tarjeta :( Recargando ...', classes: 'rounded'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/tarjetas');
                    }, 2500);
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al borrar resumen. Intenta nuevamente', classes: 'rounded red'});
                }
            }
        })
    });
}

function pagarResumen() {
    let url_hots = $('#url_host').val();
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
    
    $('#confirm_pagar_resumen').on('click',function(){
        $.ajax({
            url: url_hots+'/pagar-resumen-tarjeta',
            method: 'post',
            data: $('#frm-pagar-resumen').serialize(),
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Pagaste el Resumen con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/tarjetas');
                    }, 3000);
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al pagar. Intenta nuevamente', classes: 'rounded red'});
                }
            }
        })
    });
}
