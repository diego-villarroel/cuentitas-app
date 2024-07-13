// =========================== //
// ======== CAUCIONES ======== //
// =========================== //

function agregarCaucion() {
    let url_hots = $('#url_host').val();
    $('#activo-caucion').on('change',function(e){
        if (e.target.checked == true) {
            e.target.value = 1;
        } else {
            e.target.value = 0;
        }
    });
    
    $('#add-caucion').on('submit',function(e){
        e.preventDefault();
        let inputactivo = $('#activo-caucion').val();
        let formData = $(this).serialize()+'&activo='+inputactivo;
        $.ajax({
            url:url_hots+'/agregar-caucion',
            method: 'post',
            data: formData,
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Caución agregada con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/cauciones');
                    }, 3000);
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al agregar una Caución. Intenta nuevamente', classes: 'rounded red'});
                }
            }
        })
    });
}

function borrarCaucion() {
    let url_hots = $('#url_host').val();
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
            url: url_hots+'/borrar-caucion',
            method: 'post',
            data: $('#frm-borrar-caucion').serialize(),
            success: function(resp){
                if (resp == '1') {
                    $('#exito-borrar-caucion').removeClass('hide');
                    M.toast({html: 'Borraste la Caución :( Recargando ...', classes: 'rounded violet'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/cauciones');
                    }, 2000);
                } else {
                    M.toast({html: 'Ups! Ocurrió un error al borrar una Caución. Intenta nuevamente', classes: 'rounded red'});
                }
            }
        })
    })
}

function detalleCaucion() {
    let url_hots = $('#url_host').val();
    $('.detalle-caucion').on('click', function(){
        let id_caucion = $(this).data('id-caucion');
        $('#frm-detalle-caucion [name="id_caucion"]').val(id_caucion)
        $.ajax({
            method: 'post',
            url: url_hots+'/detalle-caucion',
            data: $('#frm-detalle-caucion').serialize(),
            success: function(resp) {
                let data = JSON.parse(resp);
                $('#detalle_ingresado').html(data.valor_ingresado);
                $('#detalle_ganancia').html(data.ganancia_neta);
                $('#detalle_devuelto').html(data.valor_devolucion);
                $('#porc_mensual').html(data.porcentaje_ganancia);
                $('#porc_anual').html(data.porcentaje_anual_ganancia);
                $('#mes').html(data.mes);
                $('#creado').html(data.creado);
                $('#dias').html(data.dias);
                $('#propietario').html(data.nombre+' '+data.apellido);
            }
        })
    });
}
