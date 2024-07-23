
// ========================== //
// ======== TARJETAS ======== //
// ========================== //

function agregarResumenTarjeta() {
    let url_hots = $('#url_host').val();
    $('#add-resumen-tarjeta').on('submit',function(e){
        e.preventDefault();
        let validar = $('#valor').val();
        let regExp = /[a-zA-Z]/;
        // 
        if (validar.includes(',')) {
            $('#valor').addClass('invalid');
            $('#error_valor').html('No está permitido usar comas');
            $('#error_valor').removeClass('d-none');
            return;
        } else if (regExp.test(validar)) {
            $('#valor').addClass('invalid');
            $('#error_valor').html('Solo números');
            $('#error_valor').removeClass('d-none');
            return;
        } else {
            $('#valor').addClass('valid');
            $('#error_valor').addClass('d-none');
        }
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
                } else if (resp == '2') {
                    M.toast({html: 'Ups! Revisá bien los datos enviados e intentá nuevamente', classes: 'rounded orange'});
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar resumen. Intenta nuevamente', classes: 'rounded red'});
                }
            },
            error: function(resp){
                if (resp.status == 500) {
                    M.toast({html: 'Ups! Revisá bien los datos enviados e intentá nuevamente', classes: 'rounded orange'});
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar resumen. Intenta nuevamente', classes: 'rounded red'});
                }
            },
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
        $('#frm-accion-resumen [name="id_resumen"]').val(resumen_select);
        
    });
    
    $('#confirm_borrar_resumen').on('click',function(){
        $.ajax({
            url: url_hots+'/borrar-resumen-tarjeta',
            method: 'post',
            data: $('#frm-accion-resumen').serialize(),
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
        $('#frm-accion-resumen [name="id_resumen"]').val(resumen_select);
        
    });
    
    $('#confirm_pagar_resumen').on('click',function(){
        $.ajax({
            url: url_hots+'/pagar-resumen-tarjeta',
            method: 'post',
            data: $('#frm-accion-resumen').serialize(),
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

function detalleResumen() {
    let url_hots = $('#url_host').val();
    $('.detalle-resumen').on('click',function(){
        $('#frm-accion-resumen [name="id_resumen"]').val($(this).data('id-resumen'))
        $.ajax({
            method:'post',
            url: url_hots+'/detalle-resumen-tarjeta',
            data: $('#frm-accion-resumen').serialize(),
            success: function(resp){
                console.log(resp);
                if (resp != '0') {
                    $('#gasto_resumen').html(resp.monto_string);
                    $('#mes_resumen').html(resp.mes_string);
                    $('#tarjeta_resumen_detalle').html(resp.nombre_tarjeta);
                    let pagado = ';'
                    if (resp.pagado == 1) {
                        pagado = '<i class="material-icons dp48 tooltipped" data-tooltip="Pagado">attach_money</i>';
                    } else {
                        pagado = '<i class="material-icons dp48 tooltipped" data-tooltip="Impago">money_off</i>';
                    }
                    $('#pagado_resumen').html(pagado);
                    $('#vencimiento_resumen_detalle').html(resp.vencimiento);
                    $('#corte_resumen').html(resp.corte);
                    $('#pollito_resumen').html(resp.nombre+' '+resp.apellido);
                    $('#banco_resumen').html(resp.nombre_banco);
                    $('.tooltipped').tooltip({
                        // specify options here
                    });
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al cargar detalles. Intenta nuevamente', classes: 'rounded red'});                    
                }
            }
        })
    })
}
