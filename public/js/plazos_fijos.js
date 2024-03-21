// ============================== //
// ======== PLAZOS FIJOS ======== //
// ============================== //

function agregarPlazoFijo() {
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
            url:'/agregar-plazo-fijo',
            method: 'post',
            data: formData,
            success: function(resp){
                if (resp == '1') {                    
                    M.toast({html: 'Plazo Fijo agregado con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace('/plazos-fijos');
                    }, 3000);
                } else {
                    console.log('error');
                }
            }
        })
    });
}

function borrarPlazoFijo() {
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
            url: '/borrar-plazo-fijo',
            method: 'post',
            data: $('#frm-borrar-pf').serialize(),
            success: function(){
                if (resp == '1') {
                    M.toast({html: 'Borraste el Plazo Fijo :( Recargando ...', classes: 'rounded violet'});
                    setInterval(() => {
                        window.location.replace('/plazos-fijos');
                    }, 2000);
                } else {
                    console.log('error');
                }
            }
        })
    });
}

function detallePlazoFijo() {
    $('.detalle_pf').on('click',function(){
        let id_pf = $(this).data('id-pf');
        $('#frm-detalle-pf [name="id_plazo_fijo"]').val(id_pf)
        $.ajax({
            url: '/detalle-plazo-fijo',
            method: 'post',
            data: $('#frm-detalle-pf').serialize(),
            success: function(resp){
                let data = JSON.parse(resp);
                $('#frm-edicion-pf [name="id_detalle_pf"]').val(data.id_plazo_fijo);
                $('#frm-edicion-pf [name="ingresado"]').val(data.valor_ingresado);
                $('#frm-edicion-pf [name="devolver"]').val(data.valor_devolucion);
                $('#frm-edicion-pf [name="persona"]').val(data.propietario);
                $('#frm-edicion-pf [name="banco"]').val(data.id_banco);
                $('#frm-edicion-pf [name="tipo_pf"]').val(data.tipo_plazo_fijo);
                $('#frm-edicion-pf [name="fecha"]').val(data.fecha_ingresado);
                $('#frm-edicion-pf [name="dias"]').val(data.cantidad_dias);
                $('#frm-edicion-pf [name="activo"]').val(data.activo);
                M.updateTextFields();
                // $('.select-dropdown').prop('disabled',true);
            }
        })
    });
}