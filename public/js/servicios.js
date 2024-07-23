// =========================== //
// ======== SERVICIOS ======== //
// =========================== //

function agregarFactura() {
    let url_hots = $('#url_host').val();
    $('#de_casa').on('change',function(e){
        if (e.target.checked == true) {
            e.target.value = 1;
        } else {
            e.target.value = 0;
        }
    })

    $('#add-factura').on('submit',function(e){
        e.preventDefault();
        let validar1 = $('#valor').val();
        let validar2 = $('#valor_mora').val();
        let regExp = /[a-zA-Z]/;
        // 
        if (validar1.includes(',')) {
            $('#valor').addClass('invalid');
            $('#error_valor').html('No está permitido usar comas');
            $('#error_valor').removeClass('d-none');
            return;
        } else if (regExp.test(validar1)) {
            $('#valor').addClass('invalid');
            $('#error_valor').html('Solo números');
            $('#error_valor').removeClass('d-none');
            return;
        } else if (validar2.includes(',')) {
            $('#valor_mora').addClass('invalid');
            $('#error_mora').html('Solo números');
            $('#error_mora').removeClass('d-none');
            return;
        } else if (regExp.test(validar2)) {
            $('#valor_mora').addClass('invalid');
            $('#error_mora').html('Solo números');
            $('#error_mora').removeClass('d-none');
            return;
        } else {
            $('#valor').addClass('valid');
            $('#error_valor').addClass('d-none');
            $('#valor_mora').addClass('valid');
            $('#error_mora').addClass('d-none');
        }
        let formData = $(this).serialize();
        $.ajax({
            url:url_hots+'/agregar-factura',
            method: 'post',
            data: formData,
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Factura agregada con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/servicios');
                    }, 3000);
                } else {
                    console.log('error');
                }
            }
        })
    });

}

function addServicio() {
    let url_hots = $('#url_host').val();
    $('#add-servicio').on('submit',function(e){
        e.preventDefault();
        let de_casa = $('#de_casa').prop('checked');
        if (de_casa) {
            $('#add-servicio [name="de_casa"]').val('1');
        } else {
            $('#add-servicio [name="de_casa"]').val('0');
        }
        let formData = $(this).serialize();
        console.log(de_casa);
        $.ajax({
            url:url_hots+'/agregar-servicio',
            method: 'post',
            data: formData,
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Servicio agregado con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/servicios');
                    }, 3000);
                } else if (resp == '0') {
                    M.toast({html: 'Existe un registro similar, cambiá el nombre por favor.', classes: 'rounded orange'});
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar un nuevo Tipo de Presupuesto. Intenta nuevamente', classes: 'rounded red'});
                }
            },
            error: function(resp){
                if (resp.status == 500) {
                    M.toast({html: 'Ups! Revisá bien los datos enviados e intentá nuevamente', classes: 'rounded orange'});
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar Tipo de Presupuesto. Intenta nuevamente', classes: 'rounded red'});
                }
            },
        })
    });
}

function pagarFactura() {
    let url_hots = $('#url_host').val();
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
            url: url_hots+'/pagar-factura',
            method: 'post',
            data: $('#frm-pagar-factura').serialize(),
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Pagaste la Factura con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/servicios');
                    }, 2000);
                } else {
                    console.log('error');
                }
            }
        })
    });
}

function borrarFactura() {
    let url_hots = $('#url_host').val();
    $('.borrar-resumen').on('click',function(){
        let id_factura = $(this).data('id-factura');
        let monto = $(this).data('monto');
        let vencimiento = $(this).data('vencimiento');
        let servicio = $(this).data('servicio');
        $('#valor_servicio_borrar').text(monto);
        $('#servicio_borrar').text(servicio.toUpperCase());
        $('#vencimiento_servicio_borrar').text(vencimiento);
        $('#frm-pagar-factura [name="id_factura"]').val(id_factura);
    })

    $('#confirm_borrar_factura_servicio').on('click',function(){
        $.ajax({
            url: url_hots+'/borrar-factura',
            method: 'post',
            data: $('#frm-pagar-factura').serialize(),
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Borraste la Factura :( Recargando ...', classes: 'rounded'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/servicios');
                    }, 3000);
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al borrar resumen. Intenta nuevamente', classes: 'rounded red'});
                }
            }
        })
    });
}