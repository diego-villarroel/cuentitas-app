
// ============================= //
// ======== PRESUPUESTO ======== //
// ============================= //

function agregarTipoPresupuesto() {
    let url_hots = $('#url_host').val();
    $('#add-tipo-presu').on('submit',function(e){
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url:url_hots+'/agregar-tipo-presupuesto',
            method: 'post',
            data: formData,
            beforeSend: function(){
                $('#btn-add-tipo-presu').prop('disabled',true);
            },
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Tipo de Presupuesto agregado con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/presupuesto');
                    }, 3000);
                } else if (resp == '2') {
                    M.toast({html: 'Existe un registro similar, cambiá el nombre por favor.', classes: 'rounded orange'});
                    $('#btn-add-tipo-presu').prop('disabled',false);
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar un nuevo Tipo de Presupuesto. Intenta nuevamente', classes: 'rounded red'});
                    $('#btn-add-tipo-presu').prop('disabled',false);
                }
            },
            error: function(resp){
                if (resp.status == 500) {
                    M.toast({html: 'Ups! Revisá bien los datos enviados e intentá nuevamente', classes: 'rounded orange'});
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar Tipo de Presupuesto. Intenta nuevamente', classes: 'rounded red'});
                }
                $('#btn-add-tipo-presu').prop('disabled',false);
            },
        })
    });
}

function presupuesto() {
    $('#mes').on('change',function(){
        let options = $(this)[0];
        for (opt of options) {
            if ( $(this).val() == opt.value) {
                $('#mes_string').val(opt.getAttribute('data-mes'));
                break;
            }
        }        
    });
    let url_hots = $('#url_host').val();
    $('#add-presupuesto').on('submit',function(e){
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
            url:url_hots+'/agregar-presupuesto',
            method: 'post',
            data: formData,
            beforeSend: function(){
                $('#btn-add-presu').prop('disabled',true);
            },
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Presupuesto agregado con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/presupuesto');
                    }, 3000);
                // } else if (resp == '2') {
                //     M.toast({html: 'Existe un registro similar, cambiá el nombre por favor.', classes: 'rounded orange'});
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar un nuevo Presupuesto. Intenta nuevamente', classes: 'rounded red'});
                    $('#btn-add-presu').prop('disabled',false);
                }
            },
            error: function(resp){
                if (resp.status == 500) {
                    M.toast({html: 'Ups! Revisá bien los datos enviados e intentá nuevamente', classes: 'rounded orange'});
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar Presupuesto. Intenta nuevamente', classes: 'rounded red'});
                }
                $('#btn-add-presu').prop('disabled',false);
            },
        })
    });
    // BORRAR
    $('.borrar-presu').on('click',function(){
        let id_presu = $(this).data('presupuesto');
        let nombre = $(this).data('nombre-presupuesto');
        let mes = $(this).data('mes');
        let monto = $(this).data('monto');
        $('#nombre_presu_borrar').empty().append(nombre);
        $('#mes_presu_borrar').empty().append(mes);
        $('#monto_presu_borrar').empty().append(monto);
        $('#frm-accion-gastos-presupuesto [name="id"]').val(id_presu);
        $('#frm-accion-gastos-presupuesto [name="accion"]').val('del_presu');
    });
    $('#confirm_borrar_presu').on('click',function(){
        $.ajax({
            url: url_hots+'/borrar-presupuesto',
            method: 'post',
            data: $('#frm-accion-gastos-presupuesto').serialize(),
            beforeSend: function() {
                $('#confirm_borrar_presu').prop('disabled',true);
            },
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Borraste Presupuesto con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/presupuesto');
                    }, 2000);                
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar un nuevo Presupuesto. Intenta nuevamente', classes: 'rounded red'});
                    $('#confirm_borrar_presu').prop('disabled',false);
                }
            },
            error: function(resp){
                if (resp.status == 500) {
                    M.toast({html: 'Ups! Revisá bien los datos enviados e intentá nuevamente', classes: 'rounded orange'});
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar Presupuesto. Intenta nuevamente', classes: 'rounded red'});
                }
                $('#confirm_borrar_presu').prop('disabled',false);
            },
        })
    });
    // GRAFICOS
    $('.graf-presupuestos').each(function(){ 
        let ctx = document.getElementById('presupuesto-'+$(this).val());
        let valores = $('#valores-'+$(this).val()).val().split(',');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [''],
                datasets: [
                    {
                        axis: 'y',
                        label: 'Gastado',
                        data: [valores[0]],
                        borderWidth: 1
                    },
                    {
                        axis: 'y',
                        label: 'Restante',
                        data: [valores[1]],
                        borderWidth: 1
                    },
                ]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                scales: {
                    x: {
                        stacked: true,
                        title: {
                            color: 'black',
                            display: true,
                            text: 'Monto en Pesos'
                        }
                    },
                    y: {
                        stacked: true,
                    }
                }

            }
        });
    })
}

function gastoPresupuesto() {
    let url_hots = $('#url_host').val();
    $('.nuevo-gasto').on('click',function(){
        let presupuesto = $(this).data('presupuesto');
        let nombre_presupuesto = $(this).data('nombre-presupuesto');
        if (presupuesto != '') {
            $('#id_presu_select').val(presupuesto);
            $('#nombre_presu_select').val(nombre_presupuesto);
            $('#nombre_presu_select').prop('disabled',true);
            $('#seccion_inicio').addClass('d-none');
            $('#seccion_presu').removeClass('d-none');
        }
    });
    $('#add-gasto-presupuesto').on('submit',function(e){
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
            url:url_hots+'/generar-gasto',
            method: 'post',
            data: formData,
            beforeSend: function() {
                $('#btn-add-gasto').prop('disabled',true);
            },
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Gastaste con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace(url_hots+window.location.pathname);
                    }, 3000);
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al Gastar. Intenta nuevamente', classes: 'rounded red'});
                    $('#btn-add-gasto').prop('disabled',false);
                }
            },
            error: function(resp){
                if (resp.status == 500) {
                    M.toast({html: 'Ups! Revisá bien los datos enviados e intentá nuevamente', classes: 'rounded orange'});
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al Gastar. Intenta nuevamente', classes: 'rounded red'});
                }
                $('#btn-add-gasto').prop('disabled',false);
            },
        })
    });
    // BORRAR
    $('.borrar-gasto').on('click',function(){
        let id_gasto = $(this).data('id-gasto');
        let gasto = $(this).data('monto');
        let fecha = $(this).data('fecha');
        let nombre = $(this).data('nombre');
        $('#nombre_gasto_borrar').empty().append(nombre);
        $('#fecha_gasto_borrar').empty().append(fecha);
        $('#monto_gasto_borrar').empty().append(gasto);
        $('#frm-accion-gastos-presupuesto [name="id"]').val(id_gasto);
        $('#frm-accion-gastos-presupuesto [name="accion"]').val('del_gasto');
    });
    $('#confirm_borrar_gasto').on('click',function(){
        $.ajax({
            url: url_hots+'/borrar-gasto',
            method: 'post',
            data: $('#frm-accion-gastos-presupuesto').serialize(),
            beforeSend: function(){
                $('#confirm_borrar_gasto').prop('disabled',true);
            },
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Borraste Gasto con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/presupuesto');
                    }, 2000);
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al Borrar Gasto. Intenta nuevamente', classes: 'rounded red'});
                    $('#confirm_borrar_gasto').prop('disabled',false);
                }
            },
            error: function(resp){
                if (resp.status == 500) {
                    M.toast({html: 'Ups! Revisá bien los datos enviados e intentá nuevamente', classes: 'rounded orange'});
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al Borrar Gasto. Intenta nuevamente', classes: 'rounded red'});
                }
                $('#confirm_borrar_gasto').prop('disabled',false);
            },
        });
    });
}