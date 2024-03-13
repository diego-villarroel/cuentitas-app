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
                    $('#exito-add-caucion').removeClass('hide');
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
