// =========================== //
// ======== CAUCIONES ======== //
// =========================== //

function agregarCaucion() {
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
            url:'/agregar-caucion',
            method: 'post',
            data: formData,
            success: function(resp){
                if (resp == '1') {
                    M.toast({html: 'Caución agregada con éxito! Recargando ...', classes: 'rounded green'});
                    setInterval(() => {
                        window.location.replace('/cauciones');
                    }, 3000);
                } else {
                    console.log('error');
                }
            }
        })
    });
}

function borrarCaucion() {
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
            url: '/borrar-caucion',
            method: 'post',
            data: $('#frm-borrar-caucion').serialize(),
            success: function(){
                if (resp == '1') {
                    $('#exito-borrar-caucion').removeClass('hide');
                    M.toast({html: 'Borraste la Caución :( Recargando ...', classes: 'rounded violet'});
                    setInterval(() => {
                        window.location.replace('/cauciones');
                    }, 2000);
                } else {
                    console.log('error');
                }
            }
        })
    })
}

function detalleCaucion() {
    $('.detalle-caucion').on('click', function(){
        let id_caucion = $(this).data('id-caucion');
        $('#frm-detalle-caucion [name="id_caucion"]').val(id_caucion)
        $.ajax({
            method: 'post',
            url: '/detalle-caucion',
            data: $('#frm-detalle-caucion').serialize(),
            success: function(resp) {
                let data = JSON.parse(resp);
                $('#frm-edicion-caucion [name="id_caucion"]').val(data.id_caucion);
                $('#frm-edicion-caucion [name="ingresado"]').val(data.valor_ingresado);
                $('#frm-edicion-caucion [name="devolver"]').val(data.valor_devolucion);
                $('#frm-edicion-caucion [name="persona"]').val(data.propietario);
                $('#frm-edicion-caucion [name="fecha"]').val(data.creado);
                $('#frm-edicion-caucion [name="dias"]').val(data.dias);
                $('#frm-edicion-caucion [name="activo"]').val(data.activo);
                M.updateTextFields();
                $('.select-dropdown').prop('disabled',true);
            }
        })
    });
}
