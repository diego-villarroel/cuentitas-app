// ============================== //
// ======== PLAZOS FIJOS ======== //
// ============================== //

function agregarPlazoFijo() {
    let url_hots = $('#url_host').val();
    $('#activo-plazo-fijo').on('change',function(e){
        if (e.target.checked == true) {
            e.target.value = 1;
        } else {
            e.target.value = 0;
        }
    });
    
    $('#add-plazo-fijo').on('submit',function(e){
        e.preventDefault();
        let inputactivo = $('#activo-plazo-fijo').val();
        let formData = $(this).serialize()+'&activo='+inputactivo;
        $.ajax({
            url:url_hots+'/agregar-plazo-fijo',
            method: 'post',
            data: formData,
            success: function(resp){
                if (resp == '1') {                    
                    M.toast({html: 'Plazo Fijo agregado con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/plazos-fijos');
                    }, 3000);
                } else {
                    console.log('error');
                }
            }
        })
    });
}

function borrarPlazoFijo() {
    let url_hots = $('#url_host').val();
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
        
    });
    
    $('#confirm_borrar_pf').on('click',function(){
        $.ajax({
            url: url_hots+'/borrar-plazo-fijo',
            method: 'post',
            data: $('#frm-borrar-pf').serialize(),
            success: function(){
                if (resp == '1') {
                    M.toast({html: 'Borraste el Plazo Fijo :( Recargando ...', classes: 'rounded violet'});
                    setInterval(() => {
                        window.location.replace(url_hots+'/plazos-fijos');
                    }, 2000);
                } else {
                    console.log('error');
                }
            }
        })
    });
}

function detallePlazoFijo() {
    let url_hots = $('#url_host').val();
    $('.detalle_pf').on('click',function(){
        let id_pf = $(this).data('id-pf');
        $('#frm-detalle-pf [name="id_plazo_fijo"]').val(id_pf)
        $.ajax({
            url: url_hots+'/detalle-plazo-fijo',
            method: 'post',
            data: $('#frm-detalle-pf').serialize(),
            success: function(resp){
                let data = JSON.parse(resp);
                $('#detalle_ingresado').html(data.ingresado_string);
                $('#detalle_ganancia').html(data.ganancia_neta_string);
                $('#detalle_devuelto').html(data.devolucion_string);
                $('#porc_ganancia').html(data.porcentaje_ganancia_string);
                $('#porc_anual').html(data.porcentaje_ganancia_anual_string);
                $('#creado').html(data.fecha_ingresado);
                $('#dias').html(data.cantidad_dias);
                $('#quien').html(data.nombre_p+' '+data.apellido_p);
                $('#devolucion').html(data.fecha_devolucion);
                $('#banco').html(data.nombre_banco);
            }
        })
    });
}